
let year=2023
$('#add_new_row').on('click',function () {
    $('#pay_row').append(
        '<tr>' +
            '<td>' +
                '<div class="form-group exp_group">'+
                        '<select name="year[]" id="year" class="form-control exp-form-control" required>'+
                            '<option value="">--Year--</option>'+
                            '<option value="2018">2018</option>'+
                            '<option value="2019">2019</option>'+
                            '<option value="2020">2020</option>'+
                            '<option value="2021">2021</option>'+
                            '<option value="2022">2022</option>'+
                            '<option value="2023">2023</option>'+
                            '<option value="2024">2024</option>'+
                            '<option value="2025">2025</option>'+
                            '<option value="2026">2026</option>'+
                            '<option value="2026">2027</option>'+
                            '<option value="2028">2028</option>'+
                            '<option value="2029">2029</option>'+
                            '<option value="2030">2030</option>'+
                        '</select>'+
                '</div>'+
            '</td>'+
            '<td>' +
                '<div class="form-group exp_group">'+
                    '<select name="month[]" id="month" class="form-control exp-form-control" required>'+
                        '<option value="">--Month--</option>'+
                        '<option value="">--Month--</option>'+
                        '<option value="1">January</option>'+
                        '<option value="2">February</option>'+
                        '<option value="3">March</option>'+
                        '<option value="4">April</option>'+
                        '<option value="5">May</option>'+
                        '<option value="6">June</option>'+
                        '<option value="7">July</option>'+
                        '<option value="8">August</option>'+
                        '<option value="9">September</option>'+
                        '<option value="10">October</option>'+
                        '<option value="11">November</option>'+
                        '<option value="12">December</option>'+
                    '</select>'+
                '</div>'+
            '</td>'+
            '<td>' +
                 '<div class="form-group exp_group">'+
                    '<input type="number" class="form-control exp-form-control" value=""  name="amount[]" id="amount" placeholder="Amount" required>'+
                 '</div>'+
            '</td>'+
        '</tr>'
    )
});