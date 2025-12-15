// Interfaces baseadas no JSON que você mostrou
interface DashboardData {
    user_logged: {
        username: string;
        type_user_id: number | string;
    };
    product_top_sale: {
        id: number;
        name: string;
        total_sold: string;
    };
    moviments_sales: Array<{
        name: string;
        quantity_moved: number;
        created_at: string;
    }>;
    total_sales: string;
    sales_categorys: Array<{
        category_name: string;
        total_quantity: string;
        total_sales: string;
    }>;
}

interface ApiResponse {
    status: boolean;
    message: string;
    data: DashboardData;
}