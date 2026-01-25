import $ from 'jquery';
import "flatpickr/dist/flatpickr.css";
import { Toast } from '../../components/Swal/swal';
import { getUserLoggedController } from '../../Controllers/User/getUserLogged';
import { DashboardController } from '../../Controllers/Dashboard/Dashboard';
import { DatePicker } from '../../components/DatePicker/flatpickr';

$(document).ready(() => {
    const $username          = $('#user_name');
    const $typeUserId        = $('#type_user_id');
    const $totalSales        = $('#total_sales');
    const $topSellingProduct = $('#top_selling_product');
    const $datePickerId      = $("#date_range_picker"); 
    const $btn_submit        = $("#btn_submit");
    const originalText       = $btn_submit.html();

    getUserLoggedController.loadUserLogged($username, $typeUserId);

    let startFilter: string;
    let endFilter:   string;

    DatePicker.initRange($datePickerId, (start, end) => {
        startFilter = start;
        endFilter   = end;
    });

    $btn_submit.on('click', async function(e) {
        e.preventDefault();
        if (!startFilter || !endFilter) {
            Toast.info("Selecione uma data completa"); 
            return;
        }
        
        $btn_submit.html('Buscando...').prop('disabled', true);

        await DashboardController.loadDashboard(startFilter, endFilter, $totalSales, $topSellingProduct);

        $btn_submit.html(originalText).prop('disabled', false);
    });

    $btn_submit.trigger('click')
    $btn_submit.html(originalText).prop('disabled', false);
});