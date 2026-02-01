export interface ApiResponse<Type> {
    success: boolean;      
    message?: string; 
    status: boolean;      
    data?: Type;               
    errors?: string[];      
}