import $ from 'jquery';
import { openModal } from '../../../utils/openModal';
import { closeModal } from '../../../utils/CloseModal';
import { maskCpf } from '../../../utils/cpfMask';
import { showUsersTable } from './tableUsers';
import { ShowModalCreateUser } from '../../../components/User/ModalCreateUser';
import { showUserLogged } from '../../../components/User/ShowUserLogged';

$(document).ready( async () => {
    const $textHeaderUsername = $('#text-header-username');
    const $textHeaderTypeUser = $('#text-header-type-user');

    const $btnOpenCreateUser    = $('#btn-open-create-user');
    const $btnSubmitSearchUser  = $('#btn-submit-search-user');
    const $inputSearchUser      = $('#input-search-user');
    const $selectFilterTypeUser = $('#select-filter-type-user');
    const $selectFilterStatus   = $('#select-filter-status');

    const $tableUsers        = $('#table-users');

    const $btnPaginationPrev = $('#btn-pagination-prev');
    const $btnPaginationNext = $('#btn-pagination-next');

    const $modalCreateUser      = $('#modal-create-user');
    const $btnModalClose        = $('#btn-modal-close');
    const $btnModalCancel       = $('#btn-modal-cancel');
    const $btnModalSave         = $('#btn-modal-save'); 
    const $inputCreateName      = $('#input-create-name');
    const $inputCreateUsername  = $('#input-create-username');
    const $inputCreateEmail     = $('#input-create-email');
    const $selectCreateTypeUser = $('#select-create-type-user');
    const $inputCreatePassword  = $('#input-create-password');
    const $inputCreateCpf       = $('#input-create-cpf');

    await showUsersTable($tableUsers);
    await showUserLogged($textHeaderUsername, $textHeaderTypeUser);

    $btnOpenCreateUser.on('click', async () => {
        openModal($modalCreateUser);

        $inputCreateCpf.on('input', function() {
            const typedValue = $(this).val() as string;   // mask cpf
            $(this).val(maskCpf(typedValue));
        });

        $btnModalSave.on('click', async (e) => {
            e.preventDefault();

            await ShowModalCreateUser($inputCreateName,
                $inputCreateEmail,
                $selectCreateTypeUser,
                $inputCreatePassword,
                $inputCreateCpf,
                $inputCreateUsername,
                $btnModalSave,
                $modalCreateUser,
                $tableUsers
            );
        });
    });

    $btnSubmitSearchUser.on('click',async (e) => {
        e.preventDefault();

       await showUsersTable(
            $tableUsers, 
            $inputSearchUser, 
            $selectFilterTypeUser, 
            $selectFilterStatus,
            $btnSubmitSearchUser
       );
        
    });

    $btnModalClose.on('click', () => {
        closeModal($modalCreateUser);
    });

    $btnModalCancel.on('click', () => {
        closeModal($modalCreateUser);
    });

    
});