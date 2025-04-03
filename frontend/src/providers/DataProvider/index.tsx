import api from '@/services'
import { formatedCurrency } from '@/utils/formate-values'
import { useFormik } from 'formik'
import Cookies from 'js-cookie'
import { createContext, useCallback, useEffect, useState } from 'react'
import { toast } from 'react-toastify'
import * as Yup from 'yup'
import { Product, ProductSale } from '../../interfaces/Products'
import { TDataContext, TProviderProps, TSaleProduct } from '../../types'

function serializePaymentMethods(paymentMethod: string): string {
  switch (paymentMethod) {
    case 'Dinheiro':
      return 'money'
    case 'Pix':
      return 'pix'
    case 'Cartão de Crédito':
      return 'credit_card'
    case 'Cartão de Débito':
      return 'debit_card'
    default:
      return 'money'
  }
}

export const getAuthToken = () => {
  return Cookies.get('auth_token')
}

export const DataContext = createContext<TDataContext>({} as TDataContext)

export const DataProvider = ({ children }: TProviderProps) => {
  const [products, setProducts] = useState<Product[]>([])
  const [searchProducts, setSearchProducts] = useState<Product[]>([])
  const [saleProducts, setSaleProducts] = useState<ProductSale[]>([])
  const [loading, setLoading] = useState<boolean>(true)
  const [openModalReceiptMerchandise, setOpenModalReceiptMerchandise] =
    useState(false)
  const [openModalSale, setOpenModalSale] = useState(false)
  const [openModalSaleSpun, setOpenModalSaleSpun] = useState(false)
  const [openModalCashier, setOpenModalCashier] = useState(false)
  const [getProducts, setGetProducts] = useState<boolean>(false)
  const [verifyToken, setVerifyToken] = useState<boolean>(false)

  const getToken = useCallback(async () => {
    try {
      const { data } = await api.post('/login', {
        email: 'example@example.com',
        password: 'password',
      })

      const token = data.data.token

      if (token) {
        Cookies.set('auth_token', token, {
          expires: 1,
          secure: true,
          sameSite: 'Strict',
        })
        api.defaults.headers.common.Authorization = `Bearer ${token}`
        setVerifyToken(true)
      }
    } catch (error) {
      toast.error('Erro ao efetuar login!')
    }
  }, [])

  const getProductsApi = useCallback(async () => {
    try {
      const { data } = await api.get('/products')

      setProducts(data.data)
    } catch (error) {
      toast.error('Erro ao buscar produtos \n' + error)
    } finally {
      setLoading(false)
    }
  }, [])

  useEffect(() => {
    if (!verifyToken) {
      getToken()
    } else {
      getProductsApi()
    }
  }, [getProductsApi, getToken, verifyToken])

  const schema = Yup.object().shape({
    products: Yup.array()
      .of(
        Yup.object().shape({
          productId: Yup.number().required(),
          quantity: Yup.string().required(),
        })
      )
      .required('Selecione pelo menos um produto'),
    paymentMethod: Yup.string().required('Selecione uma forma de pagamento'),
    quantity: Yup.number().optional(),
    discount: Yup.number()
      .min(0)
      .max(10, 'O desconto máximo é de 10%')
      .optional(),
    saleType: Yup.string().required('Selecione o tipo de venda'),
  })

  const handleSubmit = async (values: any, { setSubmitting }: any) => {
    const productsSerialize = values.products.map((product: TSaleProduct) => ({
      ...product,
      productId: product.productId,
      quantity:
        product.stockType === 'UN'
          ? Number(product.quantity)
          : parseFloat(product.quantity),
    }))
    const request = {
      discount: values.discount,
      paymentInstallment:
        values.paymentInstallment === 'A VISTA'
          ? 'in_cash'
          : values.paymentInstallment,
      paymentMethod: serializePaymentMethods(values.paymentMethod),
      products: productsSerialize,
    }

    if (!values.paymentInstallment) {
      delete request.paymentInstallment
    }

    try {
      if (values.saleType === 'sale') {
        const { data } = await api.post('/sales', request)
        toast.success(
          `Venda no valor de ${formatedCurrency(
            data.data.salesPrice
          )} finalizada com sucesso`
        )
      } else {
        await api.post('/sales-spun', request)
        toast.success('Venda finalizada com sucesso')
      }
      form.resetForm()
    } catch (error) {
      toast.error('Erro ao cadastrar venda \n' + error)
    } finally {
      values.saleType === 'sale'
        ? setOpenModalSale(false)
        : setOpenModalSaleSpun(false)
      setSubmitting(false)
      setGetProducts(!getProducts)
    }
  }

  const form = useFormik({
    initialValues: {
      searchCode: '',
      searchName: '',
      search: '',
      products: [],
      paymentMethod: '',
      paymentInstallment: null,
      quantity: 0,
      discount: 0,
      saleType: 'sale',
    },
    validationSchema: schema,
    onSubmit: handleSubmit,
  })

  return (
    <DataContext.Provider
      value={{
        form,
        loading,
        openModalCashier,
        openModalReceiptMerchandise,
        openModalSale,
        openModalSaleSpun,
        products,
        saleProducts,
        searchProducts,
        setLoading,
        setOpenModalCashier,
        setOpenModalReceiptMerchandise,
        setOpenModalSale,
        setOpenModalSaleSpun,
        setProducts,
        setSaleProducts,
        setSearchProducts,
      }}
    >
      {children}
    </DataContext.Provider>
  )
}
