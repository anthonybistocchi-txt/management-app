interface ProductData {
    id: number;
    name: string;
    description?: string;
    price?: number;
    provider_id?: number;
    product_category_id?: number;
    quantity?: number;
    location_id?: number;
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