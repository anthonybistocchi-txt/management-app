export interface InventoryFilters {
    category_id: string;
    location_id: string;
}

export interface InventoryRow {
    id: number;
    product_name: string;
    category_name: string | null;
    location_name: string | null;
    quantity: number | string;
    price: number | string;
    total_value: number | string;
}

export interface InventoryResponse {
    data?: InventoryRow[];
    recordsTotal?: number;
    recordsFiltered?: number;
}
