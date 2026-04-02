export interface StockCardFilters {
    product_id: string;
    location_id: string;
    date_from: string;
    date_to: string;
}

export interface StockCardRow {
    id: number;
    type: "in" | "out" | "transfer" | string;
    quantity_moved: number | string;
    quantity_before: number | string | null;
    quantity_after: number | string | null;
    description: string | null;
    movement_date: string;
    location_name: string | null;
    provider_name: string | null;
}

export interface StockCardResponse {
    data?: StockCardRow[];
    recordsTotal?: number;
    recordsFiltered?: number;
}
