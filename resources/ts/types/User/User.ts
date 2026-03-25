export interface UserData {
    id: number;
    name: string;
    active: number;
    username: string;
    email: string;
    type_user_id: number;
    cpf: string;
}

export interface UserLoggedData 
{
    username: string;
    type_user_id: number;
}

export interface CreateUser 
{
    name: string;
    username: string;
    email: string;
    password: string;
    type_user_id: number;
    cpf: string;
}

export interface UserListResponse 
{
    recordsFiltered: number;
    recordsTotal: number;
    users: UserData[];
}

export interface EditUser
{
    id: number;
    name: string;
    email: string;
    username: string;
    type_user_id: number;
    password?: string;
}


