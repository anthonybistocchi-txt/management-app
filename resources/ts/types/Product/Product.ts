interface ProductData {
    id: number;
    name: string;
}

interface NewProductData
{
    name: string;
    provider_id: number;
    price: number;
    description?: string;
}