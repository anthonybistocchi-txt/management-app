export interface StockMovement {
    date: string;
    stockIn: number;
    stockOut: number;
}

export interface LowStockAlert {
    productId: number;
    productName: string;
    currentStock: number;
    threshold: number;
}
