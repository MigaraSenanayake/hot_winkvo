$(document).ready(function () {
    /**
     * Ensure specific discount row exists based on the type
     */
    function ensureDiscountRowExists(tbody, type, label, value) {
        let discountRow = tbody.find(`.${type}-discount-row`);
        const grandTotalRow = tbody.find('.grand-total-row');
        if (discountRow.length === 0) {
            $(`
                <tr class="${type}-discount-row">
                    <td colspan="7" class="text-end"><strong style="font-size: 17px;">${label}</strong></td>
                    <td class="${type}-discount"><strong style="font-size: 17px;">${value.toFixed(2)}</strong></td>
                </tr>
            `).insertBefore(grandTotalRow);
        } else {
            discountRow.find(`.${type}-discount strong`).text(value.toFixed(2));
        }
    }

    /**
     * Remove specific discount row if no value is entered
     */
    function removeDiscountRowIfEmpty(tbody, type) {
        tbody.find(`.${type}-discount-row`).remove();
    }

    /**
     * Recalculate and update totals
     */
    function updateTotals() {
        const tbody = $('table tbody');
        let subtotal = 0;
        let totalServiceCharge = 0;

        // Calculate subtotal and service charge
        tbody.find('tr.item-row').each(function () {
            const itemTotal = parseFloat($(this).find('.item-total').text()) || 0;
            const serviceCharge = parseFloat($(this).find('td:nth-child(6)').text()) || 0;
            const qty = parseFloat($(this).find('td:nth-child(7)').text());

            subtotal += itemTotal;
            totalServiceCharge += serviceCharge * qty;
        });

        const advance = parseFloat($('#advance').val()) || 0;
        const disroom = parseFloat($('#disroom').val()) || 0;
        const dismeal = parseFloat($('#dismeal').val()) || 0;
        const disSer = parseFloat($('#disSer').val()) || 0;

        // Dynamically manage discount rows
        if (disroom > 0) {
            ensureDiscountRowExists(tbody, 'room', 'Discount for Room', disroom);
        } else {
            removeDiscountRowIfEmpty(tbody, 'room');
        }

        if (dismeal > 0) {
            ensureDiscountRowExists(tbody, 'meal', 'Discount for Meals', dismeal);
        } else {
            removeDiscountRowIfEmpty(tbody, 'meal');
        }

        if (disSer > 0) {
            ensureDiscountRowExists(tbody, 'service', 'Discount for Service Charge', disSer);
        } else {
            removeDiscountRowIfEmpty(tbody, 'service');
        }

        // Apply discounts & advance        
        totalServiceCharge -= disSer;   // Subtract service discount from service charge
        const grandTotal = (subtotal - advance - disroom - dismeal - disSer).toFixed(2);
        

        // Ensure other totals rows exist
        ensureTotalsRowExists(tbody);

        // Update totals
        tbody.find('.service-charge strong').text(totalServiceCharge.toFixed(2));
        tbody.find('.subtotal strong').text(subtotal.toFixed(2));
        tbody.find('.advance strong').text(advance.toFixed(2));
        tbody.find('.grand-total strong').text(grandTotal);
    }

    /**
     * Ensure totals rows always exist in the table
     */
    function ensureTotalsRowExists(tbody) {
        let totalsRow = tbody.find('.totals-row');
        if (totalsRow.length === 0) {
            tbody.append(`
                <tr class="totals-row">
                    <td colspan="5" class="text-end"><strong style="font-size: 17px;">Total Service Charge</strong></td>
                    <td class="service-charge"><strong style="font-size: 17px;">0.00</strong></td>
                </tr>
                <tr class="totals-row">
                    <td colspan="7" class="text-end"><strong style="font-size: 18px;">Subtotal</strong></td>
                    <td class="subtotal"><strong style="font-size: 18px;">0.00</strong></td>
                </tr>
                <tr class="totals-row">
                    <td colspan="7" class="text-end"><strong style="font-size: 18px;">Advance Payment</strong></td>
                    <td class="advance"><strong style="font-size: 18px;">0.00</strong></td>
                </tr>
                <tr class="totals-row grand-total-row">
                    <td colspan="7" class="text-end"><strong style="font-size: 20px;">Grand Total</strong></td>
                    <td class="grand-total"><strong style="font-size: 20px;">0.00</strong></td>
                </tr>
            `);
        }
    }

    // Trigger totals update on input change
    $('#disroom, #dismeal, #disSer, #advance').on('input', function () {
        updateTotals();
    });

     /**
     * Update the customer order table with fetched data
     * @param {array} orders - List of order items
     */
    function updateOrderTable(orders) {
        const tbody = $('table tbody');
        tbody.empty(); // Clear previous data

        if (orders.length > 0) {
            orders.forEach((order, index) => {
                const price = parseFloat(order.unit_price) || 0;
                const quantity = parseInt(order.quantity) || 0;                
                const lastRowIndex = tbody.find('tr.item-row').length;
                const service = parseFloat(price * 0.1);
                const price_with_service = (price * 1.1).toFixed(2);
                const total = (price_with_service * quantity).toFixed(2);


                                            

                const row = `
                    <tr class="item-row">
                        <td>${lastRowIndex + 1}</td>                        
                        <td>${order.description}</td>  
                        <td>${order.order_id}</td>                                                
                        <td></td>                  
                        <td>${price.toFixed(2)}</td>
                        <td>${service.toFixed(2)}</td>
                        <td>${quantity}</td>  
                        <td class="item-total">${total}</td>
                    </tr>
                `;
                tbody.append(row);
            });

            // Recalculate totals
            updateTotals();
            swal('Success', 'The Order Details were Added to the Invoice.', 'success');
        } else {
            tbody.append(`
                <tr>
                    <td colspan="8" class="text-center">Orders not found for this customer.</td>
                </tr>
            `);
        }
    }

    // Fetch customer details when the dropdown value changes
    $('#nic_pp, #nic').on('change', function () {
        const customerId = $(this).val();
        const url = $(this).attr('id') === 'nic_pp' ? 'searchWcus.php' : 'searchBcus.php';

        if (customerId) {
            $.ajax({
                url: url,
                type: 'POST',
                data: { customer_id: customerId },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        $('#id').val(response.id);
                        $('#name').val(response.name);
                        $('#bname').val(response.bname);
                        $('#email').val(response.email);
                        $('#room_pack').val(response.room_pack);
                        $('#room').val(response.room);
                        $('#advance').val(response.advance);
                        $('#booking').val(response.booking);
                        $('#days').attr('value', response.days);                                     

                    } else {
                        swal('Error', response.message || 'Failed to fetch Customer Details.', 'error');
                    }
                },
                error: function () {
                    swal('Error', 'An Error occurred while fetching Customer Details.', 'error');
                },
            });
        }
    });    

    // Fetch orders on "Search" button click
    $('#search, #search2').on('click', function () {
        const customerId = $(this).attr('id') === 'search' ? $('#nic_pp').val() : $('#nic').val();
        const url = $(this).attr('id') === 'search' ? 'fetch_orders.php' : 'fetch_orders2.php';

        if (!customerId) {
            swal('Warning', 'Please select a customer NIC or Passport Num.', 'warning');
            return;
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: { customer_id: customerId },
            dataType: 'json',
            success: function (response) {
                if (Array.isArray(response)) {
                    updateOrderTable(response);
                    
                } else {
                    swal('Error', 'Invalid Response from the Server.', 'error');
                }
            },
            error: function () {
                swal('Error', 'An Error occurred while fetching Order Details. Please try again.', 'error');
            },
        });
    });

    // Add a service to the invoice
    $('#addService').on('click', function () {
        const service = $('#service').val().trim();
        const qty = parseInt($('#qty').val());
        const servicePre = parseInt($('#servicePre').val());
        const price = parseFloat($('#price').val());

        if (!service) {
            swal('Warning', 'Service or Item Name Cannot be Empty.', 'warning');
            return;
        }

        if (isNaN(qty) || qty <= 0) {
            swal('Warning', 'Please Enter a Valid Quantity Greater than 0.', 'warning');
            return;
        }

        if (servicePre < 0) {
            swal('Warning', 'Please Enter a Valid value as service charge. (0 or more)', 'warning');
            return;
        }

        if (isNaN(price) || price <= 0) {
            swal('Warning', 'Please Enter a Valid Price Greater than 0.', 'warning');
            return;
        }

        // Calculate total for the new service

        const s_char = servicePre;
        const price_with_servi = (price + s_char);
        const total = parseFloat(qty * price_with_servi);    
        const tbody = $('table tbody');
        const lastRowIndex = tbody.find('tr.item-row').length || 0;        
    
        // Ensure totals rows exist
        ensureTotalsRowExists(tbody);

        // Add new row before totals
        
        const newRow = `
            <tr class="item-row">
                <td>${lastRowIndex + 1}</td>
                <td>${service}</td>
                <td></td>                
                <td></td>
                <td>${price.toFixed(2)}</td>
                <td>${s_char.toFixed(2)}</td>   
                <td>${qty}</td>             
                <td class="item-total">${total.toFixed(2)}</td>
            </tr>
        `;
        // Check if totals row exists before inserting the new row
        const totalsRow = tbody.find('.totals-row:first');
        if (totalsRow.length > 0) {
            totalsRow.before(newRow); // Insert before totals row
        } else {
            tbody.append(newRow); // Fallback: Append to the end of the table
        }

        // Recalculate totals
        updateTotals();

        // Clear input fields for the next entry
        $('#service').val('');
        $('#servicePre').val('')
        $('#qty').val('1');
        $('#price').val('');

        swal('Success', 'The Service or Item added to the Invoice.', 'success');
    });

    $('#addPack').on('click', function () {
        const packageId = parseInt($('#packageId').val());
        const package_name = $('#package_name').val().trim();
        const packQty = parseInt($('#packQty').val());
        const rPrice = parseFloat($('#rPrice').val());
        const s_charge = parseFloat($('#s_charge').val());
    
        // Validate inputs
        if (!packageId) {
            swal('Warning', 'Package ID Cannot be Empty.', 'warning');
            return;
        }
    
        if (isNaN(packQty) || packQty <= 0) {
            swal('Warning', 'Please Enter a Valid Quantity Greater than 0.', 'warning');
            return;
        }
    
        const totalRoom = rPrice + s_charge;
        const total = packQty * totalRoom;
    
        if (isNaN(total)) {
            swal('Error', 'Total calculation failed. Check inputs.', 'error');
            return;
        }
    
        const tbody = $('table tbody');
    
        // Ensure totals rows exist
        ensureTotalsRowExists(tbody);
    
        // Add new row
        const lastRowIndex = tbody.find('tr.item-row').length || 0;
        const newRow = `
            <tr class="item-row">
                <td>${lastRowIndex + 1}</td>
                <td>${package_name}</td>
                <td></td>               
                <td>${rPrice.toFixed(2)}</td>
                <td></td>
                <td>${s_charge.toFixed(2)}</td>
                <td>${packQty}</td>            
                <td class="item-total">${total.toFixed(2)}</td>
            </tr>
        `;
    
        // Check if totals row exists before inserting the new row
        const totalsRow = tbody.find('.totals-row:first');
        if (totalsRow.length > 0) {
            totalsRow.before(newRow); // Insert before totals row
        } else {
            tbody.append(newRow); // Fallback: Append to the end of the table
        }
    
        // Recalculate totals
        updateTotals();
    
        // Clear input fields
        $('#package_name').val('');
        $('#s_charge').val('');
        $('#packageId').val('');
        $('#packQty').val('1');
        $('#rPrice').val('');
    
        swal('Success', 'The Room Package added to the Invoice.', 'success');
    });
    
    const discountCheckbox = document.getElementById('discount');
    const discountSection = document.getElementById('discount-section');    
    const addButton = document.getElementById('add');
    
    // Toggle discount section visibility
    discountCheckbox.addEventListener('change', function () {
        if (this.checked) {
            discountSection.style.display = 'flex'; // Show the section horizontally            
        } else {
            discountSection.style.display = 'none'; // Hide the section
        }
    });
    
});

$('#cash_cardBtn').click(function () {
    const { customerId, orderIds, billTotal, booking } = collectPaymentData();
    const cashGiven = parseFloat($('#cashPIn').val());
    const cardGiven = parseFloat($('#cardIn').val());
    const cardNumbers = $('#cardNoCardCash').val().trim(); // Multiple card numbers
    

    handlePayment({
        customerId,
        orderIds,
        billTotal,
        booking,
        paymentMethod: 'cash & card',
        cashGiven,
        cardGiven,
        cardNumbers, // Multiple card numbers as a string       
        ajaxUrl: 'save_payment2.php',
        modalId: 'card_cashModal',
    });
});

$('#w_cash_cardBtn').click(function () {
    const { customerId, orderIds, billTotal } = collectPaymentData();
    const cashGiven = parseFloat($('#cashPIn').val());
    const cardGiven = parseFloat($('#cardIn').val());
    const cardNumbers = $('#cardNoCardCash').val().trim(); // Multiple card numbers
    
    handlePayment({
        customerId,
        orderIds,
        billTotal,
        paymentMethod: 'cash & card',
        cashGiven,
        cardGiven,
        cardNumbers, // Multiple card numbers as a string        
        ajaxUrl: 'save_payment.php',
        modalId: 'card_cashModal',
    });
});

// Button to show Currency Calculator Modal
document.getElementById('calbtn').addEventListener('click', function () {
    const grandTotal = parseFloat($('.grand-total strong').text()) || 0; // Fetch grand total
    const totalPriceCal = document.getElementById('totalPriceCal');

    if (totalPriceCal) {
        totalPriceCal.value = grandTotal.toFixed(2); // Set total price in the calculator
        const CalModal = new bootstrap.Modal(document.getElementById('CalModal'));
        CalModal.show(); // Show the Currency Calculator modal
    }
});

// Button to handle Proceed to Payment based on selected Payment Type
document.getElementById('prospay').addEventListener('click', function () {
    const paymentType = document.getElementById('ptype').value; // Get selected payment type
    const grandTotal = parseFloat($('.grand-total strong').text()) || 0; // Fetch grand total

    if (paymentType === "Card Payment") {
        document.getElementById('totalPriceCardCash').value = grandTotal.toFixed(2); // Set total price in card modal
        const cardModal = new bootstrap.Modal(document.getElementById('cardModal'));
        cardModal.show(); // Show the Card Payment modal
    } else if (paymentType === "Cash Payment") {
        document.getElementById('totalPriceCash').value = grandTotal.toFixed(2); // Set total price in cash modal
        const cashModal = new bootstrap.Modal(document.getElementById('cashModal'));
        cashModal.show(); // Show the Cash Payment modal
    } else if (paymentType === "Card_Cash Payment") {
        document.getElementById('totalPriceCardCash').value = grandTotal.toFixed(2); // Set total price in Card & Cash modal
        const card_cashModal = new bootstrap.Modal(document.getElementById('card_cashModal'));
        card_cashModal.show(); // Show the Card & Cash Payment modal
    } else {
        swal('Warning', 'Please select a payment type.', 'warning'); // Alert if no payment type is selected
    }
});

// Card & Cash Modal - Calculate Remaining Amount for Card
document.getElementById('cashPIn').addEventListener('input', function () {
    const totalPriceCardCash = parseFloat(document.getElementById('totalPriceCardCash').value) || 0;
    const cashPaid = parseFloat(this.value) || 0;
    const cardAmount = totalPriceCardCash - cashPaid;

    if(cashPaid > totalPriceCardCash){
        document.getElementById('cardIn').value = 'Invalid Cash Input'; 
    }
    else if(cashPaid === totalPriceCardCash){
        document.getElementById('cardIn').value = '0.00';
    }
    else{
        document.getElementById('cardIn').value = cardAmount.toFixed(2);
    }
});    

document.getElementById('otherCurre').addEventListener('input', function () {
    const totalPrice = parseFloat(document.getElementById('totalPriceCal').value) || 0; // Get the total price
    const currValue = parseFloat(this.value) || 0; // Get the entered cash amount
    const balance = totalPrice/currValue; // Calculate the balance

    document.getElementById('priceOther').value = balance.toFixed(2); // Display other currency
});

// Cash Modal - Calculate Balance
document.getElementById('cashInput').addEventListener('input', function () {
    const totalPriceCash = parseFloat(document.getElementById('totalPriceCash').value) || 0;
    const cashPaid = parseFloat(this.value) || 0;
    const balance = cashPaid - totalPriceCash;

    if(cashPaid < totalPriceCash){
        document.getElementById('balanceOutput').value = 'Insufficient Cash';
    }
    else{
        document.getElementById('balanceOutput').value = balance.toFixed(2); // Calculate and display balance
    }    
});

function printInvoice(paymentId, paymentMethod, cashGiven = 0, balance = 0) {
    cashGiven = Number(cashGiven) || 0; 
    balance = Math.abs(Number(balance)) || 0;

    const tableContent = document.querySelector('.table-responsive');
    if (!tableContent) {
        alert("Table content not found! Check the selector.");
        return;
    }

    const billingName = document.querySelector('#bname')?.value || document.querySelector('#name')?.value || "Unknown Customer";
    const roomNumbers = document.querySelector('#room')?.value || "N/A";
    const currentDateTime = new Date().toLocaleString();
    

    const paymentDetails = `
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="text-align: left;">
                <h2><strong>Cashier Name:</strong> ${cashierName}</h2>    
            </div>
            <div style="text-align: right;">
                <h2><strong>Payment Method:</strong> ${paymentMethod}</h2>
            </div>
        </div>    
    `;

    const receiptContent = `
        <div>
            <div style="text-align: center;">
                <img src="../../pic/logo copy.png" style="height: 120px; width: auto;">    
                <h2><strong style="font-size: 38px;">Subaseth Villa (Pvt) Ltd</strong></h2>  
                      
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; gap: 25px;">
                <div style="text-align: left;">
                    <h2>283, Samanalagama, Mahabulankulama, Anuradhapura, Sri Lanka</h2>
                    <h2>Phone: 025 4939850 / 076 6955164</h2>
                </div>
                <div style="text-align: right;">
                    <h2>Office: 103/A, Nagahawela, Kotikawatte, Sri Lanka</h2>
                    <h2>Phone: 077 3529146 / 077 9122548</h2>
                </div>
            </div>
            <hr>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div style="text-align: left;">
                    <h2><strong>Customer Name:</strong> ${billingName}</h2>
                    <h2><strong>Room Numbers:</strong> ${roomNumbers}</h2>
                </div>
                <div style="text-align: right;">
                    <h2><strong>Bill Number:</strong> ${paymentId}</h2>   
                    <h2><strong>Invoice Date & Time:</strong> ${currentDateTime}</h2>  
                </div>
            </div>         
            ${paymentDetails}
            <hr>
            <div style="margin-top: 20px; font-size: 14px;">
                ${tableContent.innerHTML}
            </div>
            <div style="margin-top: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #ccc; padding-top: 10px;">
                    <div style="font-size: 18px; text-align: left;">
                        <p><strong>Cash Given:</strong></p>
                        <p><strong>Balance:</strong></p>
                    </div>
                    <div style="font-size: 18px; text-align: right;">
                        <p><strong>${cashGiven.toFixed(2)}</strong></p>
                        <p><strong>${balance.toFixed(2)}</strong></p> 
                    </div>
                </div>
            </div>   
            <hr>
            <h2 style="text-align: center;">Thank you for choosing Subaseth Villa! We look forward to serving you again.</h2> 
             <br>       
            <h2 style="text-align: center;"><strong>Software By WINKVO Software Solution</strong></h2>
            <h2 style="text-align: center;"><strong>Any software needs, contact us at 076 947 1721.</strong></h2> 
            
           
                   
        </div>
    `;

    const popup = window.open('', '_blank', 'width=700,height=800');
    if (!popup) {
        alert("Popup blocked! Allow popups to see the preview.");
        return;
    }

    popup.document.write(`
        <html>
            <head>
                <title>Invoice Preview</title>
                <style>
                    body { 
                        font-family: Arial, sans-serif; 
                        font-size: 12px; 
                    }
                    @media print {
                        body {
                            width: 210mm; /* A4 paper width */
                            height: 297mm; /* A4 paper height */
                            margin: 0;
                            padding: 20mm;
                        }
                        button { display: none; }/* Hide print button when printing */
                        @page { margin: 0; }
                    }
                </style>
            </head>
            <body>
                ${receiptContent}                
                <button onclick="this.style.display='none'; window.print();" style="display: block; margin: 20px auto;">Print</button>
            </body>
        </html>
    `);
    popup.document.close();
    popup.onafterprint = () => {
        popup.close();
    };
}

function sendInvoice(paymentId, paymentMethod, cashGiven = 0, balance = 0) {
    const customerEmail = document.querySelector('#email')?.value;    
    

    if (!customerEmail) {
        swal('Error', 'Customer email is missing. Please check the email field.', 'error');
        return;
    }

    // Ensure cashGiven and balance are numbers
    cashGiven = Number(cashGiven) || 0; // Default to 0 if not a number
    balance = Math.abs(Number(balance)) || 0; // Convert to number, default to 0, and ensure positive

    // Retrieve table content for invoice items
    const tableContent = document.querySelector('.table-responsive');
    if (!tableContent) {
        alert("Table content not found! Check the selector.");
        return;
    }

    // Retrieve necessary details
    const billingName = document.querySelector('#bname')?.value || document.querySelector('#name')?.value || "Unknown Customer";
    const roomNumbers = document.querySelector('#room')?.value || "N/A";
    const currentDateTime = new Date().toLocaleString();
    

    // Payment Details Section
    const paymentDetails = `
        <tr>
            <td style="text-align: left; padding: 5px;"><h2><strong>Cashier Name:</strong> ${cashierName}</h2></td>
            <td style="text-align: right; padding: 5px;"><h2><strong>Payment Method:</strong> ${paymentMethod}</h2></td>
        </tr>
    `;

    // Generate Receipt Content (shared between print and email)
    const receiptContent = `
        <table style="width: 100%; font-family: Arial, sans-serif; border-collapse: collapse;">
            <tr>
                <td colspan="2" style="text-align: center; padding: 20px;">
                   <h2><strong style="font-size: 38px;">Subaseth Villa (Pvt) Ltd</strong></h2>
                </td>
            </tr>
            <tr>
                <td style="text-align: left;">
                    <h3>283, Samanalagama, Mahabulankulama,<br>Anuradhapura, Sri Lanka</h3>
                    <h3>Phone: 025 4939850 / 076 6955164</h3>
                </td>
                <td style="text-align: right;">
                    <h3>Office: 103/A, Nagahawela,<br>Kotikawatte, Sri Lanka</h3>
                    <h3>Phone: 077 3529146 / 077 9122548</h3>
                </td>
            </tr>
            <tr>
                <td style="text-align: left;">
                    <h3><strong>Customer Name:</strong> ${billingName}</h3>
                    <h3><strong>Room Numbers:</strong> ${roomNumbers}</h3>
                </td>
                <td style="text-align: right;">
                    <h3><strong>Bill Number:</strong> ${paymentId}</h3>   
                    <h3><strong>Invoice Date & Time:</strong> ${currentDateTime}</h3>  
                </td>
            </tr>
            ${paymentDetails}
            <tr>
                <td colspan="2" style="border-top: 1px solid #ccc; padding-top: 10px;"></td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 20px;">
                    ${tableContent.innerHTML}
                </td>
            </tr>
            <tr>
                <td style="font-size: 18px; text-align: left; padding-top: 20px; padding-left: 30px;">
                    <p><strong>Cash Given:</strong></p>
                    <p><strong>Balance:</strong></p>
                </td>
                <td style="font-size: 18px; text-align: right; padding-t
                
                op: 20px; padding-right: 30px;">
                    <p><strong>${cashGiven.toFixed(2)}</strong></p>
                    <p><strong>${balance.toFixed(2)}</strong></p> 
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center; padding-top: 20px;">
                    <h3>Thank you for choosing Subaseth Villa! We look forward to serving you again./h3>
                    <br>
                    <h3><strong>Software By WINKVO Software Solution</strong></h3>
                    <h3><strong>Any software needs, contact us at 076 947 1721</strong></h3>
                </td>
            </tr>
        </table>
    `;

    // Open a new popup for printing
    const popup = window.open('', '_blank', 'width=700,height=800');
    if (!popup) {
        alert("Popup blocked! Allow popups to see the preview.");
        return;
    }

    // Write the receipt content into the popup
    popup.document.write(`
        <html>
            <head>
                <title>Invoice Preview</title>
                <style>
                    body { 
                        font-family: Arial, sans-serif; 
                        font-size: 12px; 
                    }
                    @media print {
                        body {
                            width: 210mm; /* A4 paper width */
                            height: 297mm; /* A4 paper height */
                            margin: 0;
                            padding: 20mm;
                        }
                        button { display: none; }
                        @page { margin: 0; }
                    }
                </style>
            </head>
            <body>
                ${receiptContent}              
                <button onclick="sendEmailAndCloseWindow();" style="display: block; margin: 20px auto;">Send Email</button> 
                <script>
                    function sendEmailAndCloseWindow() {
                    fetch('../../user/front_office/sendInvoice.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            paymentId:'${paymentId}', 
                            receiptContent: \`${receiptContent}\`, 
                            customerEmail: '${customerEmail}', 
                        }),
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to send invoice. Please check the server response.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            alert('Invoice sent successfully!');
                            window.close(); // Close the preview window after success
                        } else {
                            alert('Failed to send invoice: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error sending invoice:', error);
                        alert('An error occurred while sending the invoice: ' + error.message);
                    });
                }

                </script>
            </body>
        </html>
    `);

    popup.document.close();
}

function collectPaymentData() {
    const customerId = $('#id').val();
    const booking = $('#booking').val(); // Capture booking value

    const orderIds = [];
    $('table tbody tr.item-row').each(function () {
        const orderId = $(this).find('td').eq(2).text();
        orderIds.push(orderId);
    });
    const total = parseFloat($('.grand-total strong').text()) || 0;
    const advance = parseFloat($('.advance strong').text()) || 0;
    const billTotal = total + advance;
    return { customerId, orderIds, billTotal, booking, total, cash }; 
}

function handlePayment({
    
    customerId,
    orderIds,
    billTotal,
    booking,
    paymentMethod,    
    cashGiven = null,
    cardGiven = null,
    cardNumbers = null,    
    ajaxUrl,
    modalId,
}) {
    // Calculate total service charge from the table
    let totalServiceCharge = 0;
    $('table tbody tr.item-row').each(function () {
        const serviceCharge = parseFloat($(this).find('td:nth-child(6)').text()) || 0; // Service charge in 6th column
        const quantity = parseFloat($(this).find('td:nth-child(7)').text()) || 0; // Quantity in 7th column
        totalServiceCharge += serviceCharge * quantity;
    });

    const formattedOrderIds = Array.isArray(orderIds) ? orderIds.join(',') : orderIds;
   

    // Send AJAX request
    $.ajax({
        url: ajaxUrl,
        method: 'POST',
        data: {
            customer_id: customerId,
            order_ids: formattedOrderIds,
            bill_total: billTotal,
            payment_method: paymentMethod,
            cash_given: cashGiven || null,
            card_payment: cardGiven || null,
            card_number: cardNumbers,
            total_service_charge: totalServiceCharge.toFixed(2),
            booking: booking
        },
        success: function (response) {
            console.log('AJAX Response:', response); // Debug response
        try {
            const result = JSON.parse(response);
            if (result.status === 'success') {
                const paymentId = result.payment_id;
                swal({
                    title: 'Success',
                    text: result.message,
                    icon: 'success',
                    buttons: {
                        print: { text: 'Print Invoice', value: 'print' },
                        email: { text: 'Send Email', value: 'email' },
                        cancel: { text: 'Cancel', value: null, visible: true },
                    },
                }).then((value) => {
                    const balance = cashGiven ? (billTotal - cashGiven).toFixed(2) : 0;
                    if (value === 'print') {
                        printInvoice(paymentId, paymentMethod, cashGiven || 0, balance);
                        setTimeout(() => location.reload(), 1000);
                    } else if (value === 'email') {
                        sendInvoice(paymentId, paymentMethod, cashGiven || 0, balance);
                        setTimeout(() => location.reload(), 1000);
                    }
                });
            } else {
                swal('Error', result.message, 'error');
            }
        } catch (e) {
            console.error('Response Parsing Error:', e);
            swal('Error', 'Unexpected response format.', 'error');
        }
    },
    error: function (error) {
        console.error('AJAX Error:', error); // Debug error
        swal('Error', 'An error occurred while saving payment details.', 'error');
    },
});

}

$('#w_cardBtn').click(function () {
    const { customerId, orderIds, billTotal } = collectPaymentData();
    const cardNumbers = $('#cardNo').val().trim(); // Multiple card numbers
   
    handlePayment({
        customerId,
        orderIds,
        billTotal,
        paymentMethod: 'card',
        cardNumbers, // Multiple card numbers as a string        
        ajaxUrl: 'save_payment.php',
        modalId: 'w_cardModal',
    });
});

// Walk-in Cash Payment
$('#w_cashBtn').click(function () {
    const { customerId, orderIds, billTotal, total } = collectPaymentData();
    const cashGiven = parseFloat($('#cashInput').val());
    if (cashGiven < total) {
        swal('Error', 'Cash amount must be greater than or equal to the bill total.', 'error');
        return;
    }


    handlePayment({
        customerId,
        orderIds,
        billTotal,
        paymentMethod: 'cash',
        cashGiven,
        ajaxUrl: 'save_payment.php',
        modalId: 'w_cashModal',
    });
});

// In-house Card Payment
$('#cardBtn').click(function () {
    const { customerId, orderIds, billTotal, booking } = collectPaymentData();
    const cardNumbers = $('#cardNo').val().trim(); // Multiple card numbers
    
    handlePayment({
        customerId,
        orderIds,
        booking,
        billTotal,
        paymentMethod: 'card',
        cardNumbers, // Multiple card numbers as a string        
        ajaxUrl: 'save_payment2.php',
        modalId: 'cardModal',
    });
});

// In-house Cash Payment
$('#cashBtn').click(function () {
    const { customerId, orderIds, billTotal, booking, total } = collectPaymentData();
    const cashGiven = parseFloat($('#cashInput').val());
    if (cashGiven < total) {
        swal('Error', 'Cash amount must be greater than or equal to the bill total.', 'error');
        return;
    }
    
    handlePayment({
        customerId,
        orderIds,
        booking,
        billTotal,
        paymentMethod: 'cash',
        cashGiven,
        ajaxUrl: 'save_payment2.php',
        modalId: 'cashModal',
    });
});

document.getElementById('packageId').addEventListener('input', function() {
    const packageId = this.value;
    if (packageId) {
        fetch(`search_packs.php?id=${packageId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('package_name').value = data.package_name;
                    document.getElementById('rPrice').value = data.price;
                    document.getElementById('s_charge').value = data.s_charge;
                    
                } else {
                    document.getElementById('package_name').value = "Not found";
                    document.getElementById('rPrice').value = "N/A";
                    document.getElementById('s_charge').value = "N/A";
                }
            })
            .catch(error => console.error('Error:', error));
    } else {
        document.getElementById('package_name').value = '';
        document.getElementById('rPrice').value = '';
        document.getElementById('s_charge').value = '';
    }
});

