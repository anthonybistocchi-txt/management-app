import Swal from 'sweetalert2';

const baseCustomClass = {
    // Adicione 'w-auto' e 'max-w-[90vw]' para ele crescer mas respeitar a tela do celular
    popup: 'bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-lg rounded-xl w-auto max-w-[90vw]',
    
    // Remova o 'whitespace-nowrap' daqui para evitar a rolagem forçada
    title: 'text-gray-800 dark:text-gray-100 font-display', 
};

const ToastMixin = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3500,
    timerProgressBar: true,
    background: 'transparent', // Dica: use transparent se for controlar o bg via classe 'popup'
    
    // ESTA É A MÁGICA: Permite que o alerta cresça para caber o texto
    width: 'auto', 
    
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});

export const Toast = {
    success(message: string) {
        ToastMixin.fire({
            icon: 'success',
            // Adicionamos um padding extra no título para garantir que não fique apertado
            title: `<span class="px-2">${message}</span>`,
            iconColor: '#23b315ff',
            customClass: {
                ...baseCustomClass,
                timerProgressBar: 'bg-green-500' 
            }
        });
    },
    
    error(message: string) {
        ToastMixin.fire({
            icon: 'error',
            title: `<span class="px-2">${message}</span>`,
            iconColor: '#ef4444',
            customClass: {
                ...baseCustomClass,
                timerProgressBar: 'bg-red-500' 
            }
        });
    },
    
    info(message: string) {
        ToastMixin.fire({
            icon: 'info',
            title: `<span class="px-2">${message}</span>`,
            iconColor: '#f1cd00ff',
            customClass: {
                ...baseCustomClass,
                timerProgressBar: 'bg-yellow-500' 
            }
        });
    }
};