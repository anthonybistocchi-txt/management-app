interface StockInData {
    id: number;
    product_name: string;
    quantity: number;
    provider_name: string;
    stock_in_date: string;
}

interface NewProductData {
    name: string;
    description?: string;
    quantity: number;
    provider_id: number;
    date: string;
}

interface ProviderData {
    id: number;
    name: string;
}

interface ProductData {
    id: number;
    name: string;
}
interface UserLoggedData {
    user: {
        username: string;
        type_user_id: number;
    }
}

interface FormStockInData {
    product_id: number;
    quantity: number;
    provider_id: number;
    date: string;
    observations?: string | null;
}



