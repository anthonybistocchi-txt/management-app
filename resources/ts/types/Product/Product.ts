interface ProductData {
    id: number;
    stock_id?: number;
    product_id?: number;
    name: string;
    description?: string;
    price?: number;
    provider_id?: number;
    provider_name?: string;
    product_category_id?: number;
    category_name?: string;
    quantity?: number;
    location_id?: number;
    location_name?: string;
    category?: {
        id: number;
        name: string;
    } | null;
    provider?: {
        id: number;
        name: string;
    } | null;
    location?: {
        id: number;
        name: string;
    } | null;
}

interface NewProductData
{
    name: string;
    provider_id: number;
    product_category_id: number;
    price: number;
    description?: string;
    quantity?: number;
    location_id?: number;
}