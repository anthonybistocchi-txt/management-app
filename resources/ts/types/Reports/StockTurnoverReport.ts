export interface StockTurnoverFilters {
    category_id: string;
    location_id: string;
    date_from: string;
    date_to: string;
}

export interface StockTurnoverRow {
    product_id: number;
    product_name: string;
    category_name: string | null;
    total_in: number | string;
    total_out: number | string;
    turnover: number | string;
}

export interface StockTurnoverResponse {
    data?: StockTurnoverRow[];
    recordsTotal?: number;
    recordsFiltered?: number;
}
