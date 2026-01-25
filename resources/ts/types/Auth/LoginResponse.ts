
export interface User {
    type_user_id: number;
    name: string;
    email: string;
    username: string;
    cpf: string;
    active: boolean;
}

export interface LoginResponse {
    token: string;
    user: User;
}