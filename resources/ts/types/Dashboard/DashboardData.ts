interface DashboardData {
    product_top_sale: {
        id: number;
        name: string;
        total_sold: string;
    };
    moviments_sales: Array<{
        total_sold: number;
        sell_date: string;
    }>;
    total_sales: string;
    sales_categorys: Array<{
        category_name: string;
        total_quantity: string;
        total_sales: string;
    }>;
}

interface CategoryData {
    category_name: string;
    total_quantity: string; 
    total_sales: string; 
}