<?php
if (isset($_POST['data'])) {
    echo '<div id="data" style="display:none">'.json_encode($_POST['data']).'</div>';

} else {
    header('Location: summary.php');
}?>
<style>
td{
    padding:.5rem;
}
</style>
<div class="table-wrapper" id="detail-table">
							<table>
								<thead>
									<tr>
										<th>Recipe</th>
										<th>Price</th>
										<th>Calories</th>
									</tr>
								</thead>
								<tbody id="tb-body">

								</tbody>
								<tfoot>
									<tr>
										<td style="padding:.5rem">Total</td>
										<td style="padding:.5rem" id="totalPrice"></td>
                                        <td style="padding:.5rem" id="totalCal"></td>
									</tr>
								</tfoot>
							</table>
</div>

 <script>$.getScript("/assets/js/detail.js")</script>
