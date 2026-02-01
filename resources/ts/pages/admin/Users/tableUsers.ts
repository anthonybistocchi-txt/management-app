import { Toast } from "../../../components/Swal/swal";
import { UserController } from "../../../Controllers/User/UserController";
import 'datatables.net-responsive-dt';

// Mapa de Tipos de Usuário
const USER_ROLES: Record<number, string> = {
    1: 'Administrador',
    2: 'Gestor',
    3: 'Operador'
};

export async function showUsersTable(
    $tableElement:       JQuery<HTMLElement>, 
    search?:             JQuery<HTMLElement>,
    $inputOperatorType?: JQuery<HTMLElement>,
    $inputStatusUser?:   JQuery<HTMLElement>
): Promise<void> {

    const searchValue   = search             ? (search.val() as string).trim()             : '';
    const operator_type = $inputOperatorType ? ($inputOperatorType.val() as string).trim() : 'all';
    const active        = $inputStatusUser   ? ($inputStatusUser.val() as string).trim()   : 'all';

    let start  = 0;
    let length = 10;
    
    const responseData = await UserController.getAllUsers(start, length, searchValue, operator_type, active);
    
    if (!responseData || !responseData.users) {
        Toast.error("Erro ao carregar usuários.");
        return;
    }

    const usersList = responseData.users;

    const table = $tableElement.DataTable({
        data: usersList,
        destroy: true,
        autoWidth: true,
        responsive: true,

        pagingType: 'simple_numbers', 

        dom: '<"flex flex-col sm:flex-row justify-between items-center mb-5 gap-4"l>rt<"flex flex-col sm:flex-row justify-between items-center mt-5 gap-4"ip>',
        language: {
            paginate: {
                previous: '<span class="material-symbols-outlined text-sm align-middle text-gray-600">chevron_left</span>',
                next: '<span class="material-symbols-outlined text-sm align-middle text-gray-600">chevron_right</span>',
                first: '', // Remove texto se aparecer
                last: ''   // Remove texto se aparecer
            }
        },

        columns: [
        { 
            data: 'name',
            title: 'NOME',
            className: 'px-4 py-3 text-gray-800 text-sm'
        },
        { 
            data: 'username', 
            title: 'USERNAME',
            className: 'px-4 py-3 text-gray-800 text-sm' 
        },
        { 
            data: 'email', 
            title: 'EMAIL',
            className: 'px-4 py-3 text-gray-800 text-sm' 
        },
        { 
            data: 'cpf', 
            title: 'CPF',
            className: 'px-4 py-3 text-gray-800 text-sm' 
        },
        { 
            data: 'type_user_id',
            title: 'TIPO',
            className: 'px-4 py-3 text-gray-800 text-sm',
            render: function(data) {
                return USER_ROLES[data] || 'Desconhecido';
            }
        },
        { 
            data: 'active',
            title: 'STATUS',
            className: 'px-4 py-3 text-gray-800 text-sm',
            render: function(data) {
                const isActive = data === 1;
                const text = isActive ? 'Ativo' : 'Inativo';
                // Badges suaves combinam bem com o tema Clean
                const css = isActive 
                    ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' // Verde mais suave e moderno
                    : 'bg-red-50 text-red-700 border border-red-100';
                
                return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold ${css}">${text}</span>`;
            }
        },
        
        {
            data: null, 
            title: 'AÇÕES',
            className: 'px-4 py-3 text-right text-sm',
            orderable: false, 
            render: function(data, type, row) {
                const bgGrey = 'bg-gray-100 hover:bg-gray-200';
                
                return `
                    <div class="flex items-center justify-end gap-2">
                        <button class="p-2 rounded-lg text-gray-500 hover:bg-background-light hover:scale-110 transition-all duration-200"
                                data-id="${row.id}" title="Editar">
                            <span class="material-symbols-outlined text-[20px]">edit</span>
                        </button>
                        <button class="p-2 rounded-lg text-red-500 hover:text-red-600 hover:bg-red-50 hover:scale-110 transition-all duration-200"
                                data-id="${row.id}" title="Excluir">
                            <span class="material-symbols-outlined text-[20px]">delete</span>
                        </button>
                    </div>
                `;
            }
            
        }
        
    ],

       initComplete: function() {
            const columnHeader      = $('.dt-column-header')
            const $lengthSelect     = $('.dt-length select');
            const $legendSelectQnty = $('.dt-length label span');
            const $divSelectQnty    = $('.dt-length');
            const $showResultsText  = $('#table-users_info')

            $showResultsText.addClass('font-medium pl-2 text-gray-600 font-sans');
            $showResultsText.text(`Total: ${responseData.users.length} de ${responseData.total}`);

            
            columnHeader.addClass('font-sans text-gray-600  hover:scale-90 transition-all duration-200 cursor-pointer');

            $divSelectQnty.remove();
            $legendSelectQnty.remove();

            $lengthSelect.removeClass('dt-input'); 
            $lengthSelect.addClass('form-select h-10 w-20  rounded-lg border-gray-300 bg-white text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-slate-700 dark:bg-slate-800 mr-2 shadow-sm cursor-pointer');
            
            $('.dt-length').addClass('flex items-center text-sm text-gray-700 dark:text-gray-300');
        },

        drawCallback: function() {
            const $container = $(this).closest('.dt-container');
            const $nav = $container.find('.dt-paging nav');
            
            $nav.addClass('flex items-center gap-2 select-none justify-center sm:justify-end');

            const $buttons = $container.find('.dt-paging-button');

            $buttons.each(function() {
                const $btn = $(this);
                $btn.removeClass('dt-paging-button current disabled');

                // Base: Botão quadrado (w-10 h-10), fonte Manrope (se aplicada no body), transição suave
                let classes = 'relative inline-flex items-center justify-center w-10 h-10 text-sm font-bold rounded-xl transition-all duration-200 border ';

                // 1. ESTADO ATIVO (Página atual) -> Usa sua cor PRIMARY
                if ($btn.attr('aria-current') === 'page') {
                    classes += 'bg-primary text-white border-primary shadow-md shadow-primary/20 transform scale-105';
                } 
                // 2. ESTADO DESABILITADO
                else if ($btn.attr('aria-disabled') === 'true') {
                    classes += 'text-gray-300 border-transparent cursor-not-allowed';
                    $btn.prop('disabled', true);
                } 
                // 3. ESTADO NORMAL (Inativo)
                else {
                    // Fundo branco, texto cinza. No hover: Borda e Texto PRIMARY
                    classes += 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary hover:bg-background-light dark:bg-slate-800 dark:border-slate-700 dark:text-gray-300 dark:hover:border-primary';
                }

                $btn.addClass(classes);

                // Ajuste de ícone para as setas (Chevron)
                if ($btn.text().trim() === '') {
                    $btn.find('span').addClass('text-lg'); 
                }
            });

            // Ajusta a cor do texto "Mostrando 1 a 10..."
            $container.find('.dt-info').addClass('text-sm text-gray-500 dark:text-gray-400 font-medium');
        }
        
    })}
