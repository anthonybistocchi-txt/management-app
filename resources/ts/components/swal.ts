import Swal from 'sweetalert2';

const baseCustomClass = {
    popup: 'bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-lg rounded-xl',
    title: 'text-gray-800 dark:text-gray-100 font-display', 
};

const ToastMixin = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3500,
    timerProgressBar: true,
    background: 'white', 
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});

export const Toast = {
    success(message: string) {
        ToastMixin.fire({
            icon: 'success',
            title: message,
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
            title: message,
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
            title: message,
            iconColor: '#f1cd00ff',
            customClass: {
                ...baseCustomClass,
                timerProgressBar: 'bg-yellow-500' 
            }

        });
    }
};