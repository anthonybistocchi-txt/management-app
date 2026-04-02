export interface InOutFilters {
    product_id: string;
    location_id: string;
    type: string;
    provider_id: string;
    category_id: string;
    date_from: string;
    date_to: string;
}

export interface InOutReportRow {
    product_name: string;
    quantity_moved: number | string;
    movement_date: string;
    description: string | null;
    category_name: string | null;
    location_name: string | null;
    provider_name: string | null;
    type: "in" | "out" | "transfer" | string;
}

export interface InOutReportResponse {
    data?: InOutReportRow[];
    recordsTotal?: number;
    recordsFiltered?: number;
}