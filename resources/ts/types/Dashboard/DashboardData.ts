interface DashboardData {
    topSellingProduct: {
        id: number;
        name: string;
        total_sold: string;
    };
    salesMovements: Array<{
        total_sold: number;
        total_sales?: number;
        sell_date: string;
    }>;
    salesMovementsPrevious: Array<{
        total_sold: number;
        total_sales?: number;
        sell_date: string;
    }>;
    totalSalesValue: string;
    salesByCategory: Array<{
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