<div id="report_body">
    <div id="receipt_header" class="text-center" >
        <label class="bold"><?= company_name(); ?></label><br/>
        <small><?= $branch->branch_name;?></small><br/>
        <small>Sales Report</small>
    </div>
    <div class="top-10 bottom-10">
       <table class="table">
          <thead>
              <th>OR #</th>
              <th>Total</th>
              <th>Amount Due</th>
              <!-- <th>Tax</th> -->
              <th>Change</th>
              <th>Receivable</th>
              <th>Capital</th>
              <th>Revenue</th>
              <th>Date / Time</th>
          </thead>
          <?php
              $grand_total = 0.00;
              $total_tax = 0.00;
              $total_receivable = 0.00;
              $total_capital = 0.00;
              $total_revenue = 0.00;
          ?>

          <tbody>
            <?php
                foreach ($transactions as $value) {
                  ?>
                    <tr>
                      <td><small><?= $value->or_number; ?></small></td>
                      <td><small>P <?= number_format($value->total,2); ?></small></td>
                      <td><small>P <?= number_format($value->amount_due,2); ?></small></td>
                      <!-- <td><small>P <?= number_format($value->tax,2); ?></small></td> -->
                      <td><small>P <?= number_format($value->payment_change,2); ?></small></td>
                      <td><small>P <?= number_format($value->receivable,2); ?></small></td>
                      <td><small>P <?= number_format($value->capital,2); ?></small></td>
                      <td><small>P <?= number_format($value->revenue,2); ?></small></td>
                      <td><small><?= $value->date_time; ?></small></td>
                    </tr>
                  <?php


                  $grand_total += doubleval($value->total);
                  $total_tax += doubleval($value->tax);
                  $total_receivable += doubleval($value->receivable);
                  $total_capital += doubleval($value->capital);
                  $total_revenue += doubleval($value->revenue);


                }
            ?>

                    <tr>
                      <td><small></td>
                      <td><small><b>P <?= number_format($grand_total,2); ?></b></small></td>
                      <td><small><b></b></small></td>
                      <!-- <td><small><b>P <?= number_format($total_tax,2); ?></b></small></td> -->
                      <td><small><b></b></small></td>
                      <td><small><b>P <?= number_format($total_receivable,2); ?></b></small></td>
                      <td><small><b>P <?= number_format($total_capital,2); ?></b></small></td>
                      <td><small><b>P <?= number_format($total_revenue,2); ?></b></small></td>
                      <td><small><b></b></small></td>
                    </tr>
          </tbody>
       </table>
    </div>
    <div>

    </div>
</div>