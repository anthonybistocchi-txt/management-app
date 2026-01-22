interface ProviderData {
    id: number;
    name: string;
}

interface NewProviderData {
    name: string;
    cnpj: string;
    phone?: string;
    email: string;
    street: string;
    number: string;
    city: string;
    state: string;
    cep: string;
}