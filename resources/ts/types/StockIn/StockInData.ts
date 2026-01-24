interface StockInData {
    id: number;
    product_name: string;
    quantity: number;
    provider_name: string;
    stock_in_date: string;
    description: string | null;
    location_name: string;
}

interface ProviderData {
    id: number;
    name: string;
}

interface FormStockInData {
    product_id: number;
    quantity: number;
    provider_id: number;
    date: string;
    description?: string | null;
    location_id: number;
}



