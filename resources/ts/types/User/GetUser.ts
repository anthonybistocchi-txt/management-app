
export interface UsersData {
    id: number; 
    name: string;
    type_user_id: number;
    active: number;
    username: string;
    email: string;
    cpf: string;
}

export interface UsersResponse {
    users: UsersData[];
    total: number;
}

