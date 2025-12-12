import { UserTypes } from "../Utils/User";
import { DashboardKpis } from "./Kpis";
import { SalesByCategory } from "./Sales";
import { StockMovement } from "./Stock";

export interface DashboardResponse {
    kpis: DashboardKpis;
    stockMovements: StockMovement[];
    usersByType: UserTypes[];
    salesByCategory: SalesByCategory[];
}
