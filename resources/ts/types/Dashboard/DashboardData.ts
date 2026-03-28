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
    totalSalesValuePrevious: string;
    totalOrders: number;
    topProducts: Array<{
        id: number;
        name: string;
        total_sales: string;
    }>;
    recentSales: Array<{
        created_at: string;
        product_name: string;
        location_name: string | null;
        total_sales: string;
    }>;
    lowStockCount: number;
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