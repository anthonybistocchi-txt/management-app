export type DashboardSalesMetric = "revenue" | "volume";

export interface DashboardSalesMovement {
    total_sold: number;
    total_sales?: number;
    sell_date: string;
}

export interface DashboardSalesByCategory {
    category_name: string;
    total_quantity: string;
    total_sales: string;
}

export interface DashboardRecentSale {
    created_at: string;
    product_name: string;
    location_name: string | null;
    total_sales: string;
}

export interface DashboardTopProduct {
    id: number;
    name: string;
    total_sales: string;
}

export interface DashboardGraphicsElements {
    totalSales: JQuery<HTMLElement>;
    topSellingProduct: JQuery<HTMLElement>;
    averageTicket: JQuery<HTMLElement>;
    totalOrders: JQuery<HTMLElement>;
    totalSalesGrowth: JQuery<HTMLElement>;
    topProductsBody: JQuery<HTMLElement>;
    recentSalesList: JQuery<HTMLElement>;
    lowStockAlert: JQuery<HTMLElement>;
    lowStockCount: JQuery<HTMLElement>;
    lowStockMessage: JQuery<HTMLElement>;
}

export interface ShowDashboardGraphicsParams {
    startFilter: string;
    endFilter: string;
    metric: DashboardSalesMetric;
    elements: DashboardGraphicsElements;
}

export interface RenderDashboardSalesMovementsChartParams {
    data: DashboardSalesMovement[];
    metric: DashboardSalesMetric;
    previousData?: DashboardSalesMovement[];
}

export interface RenderDashboardSalesByCategoryChartParams {
    data: DashboardSalesByCategory[];
}

export interface RenderDashboardTopProductsTableParams {
    container: JQuery<HTMLElement>;
    items: DashboardTopProduct[];
}

export interface RenderDashboardRecentSalesListParams {
    container: JQuery<HTMLElement>;
    items: DashboardRecentSale[];
}

export interface RenderDashboardLowStockAlertParams {
    alertContainer: JQuery<HTMLElement>;
    countContainer: JQuery<HTMLElement>;
    messageContainer: JQuery<HTMLElement>;
    lowStockCount: number;
}

export interface RenderDashboardSalesGrowthBadgeParams {
    container: JQuery<HTMLElement>;
    totalSalesValue: number;
    totalSalesValuePrevious: number;
}