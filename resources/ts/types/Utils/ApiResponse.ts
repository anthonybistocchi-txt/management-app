// O <T> funciona como uma variável para tipagem
export interface ApiResponse<Type> {
    success: boolean;      
    message?: string; 
    status: boolean;      
    data: Type;               
    errors?: string[];      
}