<?php
if (isset($_POST['data'])) {
    echo '<div id="data" style="display:none;">'.json_encode($_POST['data']).'</div>';

} else {
    header('Location: summary.php');
}?>
<style>
@media only screen and (min-width:820px) {
    .detail{
        width:80%;
    }

}
@media only screen and (max-width:820px) {
    .detail{
        width:100%;
    }
}

td{
    padding:.5rem;
}
</style>
<div class="table-wrappe detail" id="detail-table">
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
