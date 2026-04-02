import type { DashboardSalesByCategory, DashboardSalesMovement } from "./DashboardGraphics";

declare global {
    interface DashboardData {
        topSellingProduct: {
            id: number;
            name: string;
            total_sold: string;
        };
        salesMovements: DashboardSalesMovement[];
        salesMovementsPrevious: DashboardSalesMovement[];
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
        salesByCategory: DashboardSalesByCategory[];
    }
}

export {};