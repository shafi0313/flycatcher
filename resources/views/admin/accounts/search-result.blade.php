<div class="d-flex justify-content-between">
    <!-- <div class="table-responsive mr-1">
        <table class="table table-bordered table-secondary table-striped">
            <thead>
                <tr>
                    <th colspan="2" class="text-center">Before Search Result</th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-warning">
                    <th>Total Collection</th>
                    <th class="text-right">{{number_format($collectionBeforeSearch)}} TK</th>
                </tr>

                <tr class="table-warning">
                    <th class="text-success">Merchant Paid</th>
                    <th class="text-success" class="text-right">{{number_format($merchantPaidBeforeSearch)}} TK</th>
                </tr>

                <tr class="table-warning">
                    <th>Delivery Charge <span class="text-primary">(+)</span></th>
                    <th>{{number_format($deliveryChargeBeforeSearch)}} TK</th>
                </tr>

                <tr class="table-warning">
                    <th>Delivery COD Charge <span class="text-primary">(+)</span></th>
                    <th>{{number_format($codChargeBeforeSearch)}} TK</th>
                </tr>

                <tr>
                    <th>Loan <span class="text-primary">(+)</span></th>
                    <th>{{number_format($loanBeforeSearch)}} TK</th>
                </tr>

                <tr>
                    <th>Expense <span class="text-danger">(-)</span></th>
                    <th>{{number_format($expenseBeforeSearch)}} TK</th>
                </tr>

                <tr>
                    <th>Advance <span class="text-danger">(-)</span></th>
                    <th>{{number_format($advanceBeforeSearch)}} TK</th>
                </tr>

                <tr>
                    <th>Bad Debt <span class="text-danger">(-)</span></th>
                    <th>{{number_format($badDebtBeforeSearch)}} TK</th>
                </tr>

                <tr class="table-success">
                    <th><b>Cash in Hand Without Merchant Payable (Closing Balance)</b> </th>
                    <th>
                        {{ number_format($searchBeforeClosingBalanceWithoutMerchantPayable) }} TK
                    </th>
                </tr>

                <tr class="table-warning">
                    <th class="text-danger">Merchant Payable <span class="text-primary">(+)</span></th>
                    <th class="text-danger">{{number_format($merchantPayableBeforeSearch)}} TK</th>
                </tr>
                <tr class="table-primary">
                    <th><b>Total Cash in Hand (Closing Balance)</b> </th>
                    <th>
                        {{ number_format($searchBeforeClosingBalanceWithMerchantPayable) }} TK
                    </th>
                </tr>
            </tbody>
        </table>
    </div> -->

    <div class="table-responsive">
        <table class="table table-bordered table-secondary table-striped">
            <thead>
                <tr>
                    <th colspan="2" class="text-center">Search Result</th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-info">
                    <th>Cash in Hand (Opening Balance) <span class="text-success">(+)</span></th>
                    <th class="text-right">{{number_format($searchBeforeClosingBalance)}} TK</th>
                </tr>
                <tr class="table-warning">
                    <th>Total Collection</th>
                    <th class="text-right">{{number_format($collectionBetweenSearch)}} TK</th>
                </tr>
                <tr class="table-warning">
                    <th>Delivery Charge <span class="text-primary">(+)</span></th>
                    <th class="text-right">{{number_format($deliveryChargeBetweenSearch)}} TK</th>
                </tr>

                <tr class="table-warning">
                    <th>COD Charge <span class="text-primary">(+)</span></th>
                    <th class="text-right">{{number_format($codChargeBetweenSearch)}} TK</th>
                </tr>
                <tr class="table-warning">
                    <th class="text-success">Merchant Paid</th>
                    <th class="text-success text-right">{{number_format($merchantPaidBetweenSearch)}} TK</th>
                </tr>

                <tr class="table-warning">
                    <th class="text-danger">Merchant Payable <span class="text-primary">(+)</span></th>
                    <th class="text-danger text-right">{{number_format($merchantPayableBetweenSearch)}} TK</th>
                </tr>
                <tr>
                    <th>Loan <span class="text-primary">(+)</span></th>
                    <th class="text-right">{{number_format($loanBetweenSearch)}} TK</th>
                </tr>
                <tr>
                    <th>Expense <span class="text-danger">(-)</span></th>
                    <th class="text-right">{{number_format($expenseBetweenSearch)}} TK</th>
                </tr>

                <tr>
                    <th>Advance <span class="text-danger">(-)</span></th>
                    <th class="text-right">{{number_format($advanceBetweenSearch)}} TK</th>
                </tr>

                <tr>
                    <th>Bad Debt <span class="text-danger">(-)</span></th>
                    <th class="text-right">{{number_format($badDebtBetweenSearch)}} TK</th>
                </tr>
                <tr class="table-primary">
                    <th><b>Cash in Hand (Closing Balance)</b> </th>
                    <th class="text-right">{{ number_format($searchBetweenClosingBalance) }} TK </th>
                </tr>
            </tbody>
        </table>
    </div>
</div>