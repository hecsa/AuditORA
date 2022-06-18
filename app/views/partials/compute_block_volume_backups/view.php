<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Compute Block Volume Backups</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['rowid']) ? urlencode($data['rowid']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-block_volume_id">
                                        <th class="title"> Block Volume Id: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['block_volume_id']; ?>" 
                                                data-pk="<?php echo $data['rowid'] ?>" 
                                                data-url="<?php print_link("compute_block_volume_backups/editfield/" . urlencode($data['rowid'])); ?>" 
                                                data-name="block_volume_id" 
                                                data-title="Enter Block Volume Id" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['block_volume_id']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-compartment_id">
                                        <th class="title"> Compartment Id: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['compartment_id']; ?>" 
                                                data-pk="<?php echo $data['rowid'] ?>" 
                                                data-url="<?php print_link("compute_block_volume_backups/editfield/" . urlencode($data['rowid'])); ?>" 
                                                data-name="compartment_id" 
                                                data-title="Enter Compartment Id" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['compartment_id']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-display_name">
                                        <th class="title"> Display Name: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['display_name']; ?>" 
                                                data-pk="<?php echo $data['rowid'] ?>" 
                                                data-url="<?php print_link("compute_block_volume_backups/editfield/" . urlencode($data['rowid'])); ?>" 
                                                data-name="display_name" 
                                                data-title="Enter Display Name" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['display_name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-id">
                                        <th class="title"> Id: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['id']; ?>" 
                                                data-pk="<?php echo $data['rowid'] ?>" 
                                                data-url="<?php print_link("compute_block_volume_backups/editfield/" . urlencode($data['rowid'])); ?>" 
                                                data-name="id" 
                                                data-title="Enter Id" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['id']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-lifecycle_state">
                                        <th class="title"> Lifecycle State: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['lifecycle_state']; ?>" 
                                                data-pk="<?php echo $data['rowid'] ?>" 
                                                data-url="<?php print_link("compute_block_volume_backups/editfield/" . urlencode($data['rowid'])); ?>" 
                                                data-name="lifecycle_state" 
                                                data-title="Enter Lifecycle State" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['lifecycle_state']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-source_type">
                                        <th class="title"> Source Type: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['source_type']; ?>" 
                                                data-pk="<?php echo $data['rowid'] ?>" 
                                                data-url="<?php print_link("compute_block_volume_backups/editfield/" . urlencode($data['rowid'])); ?>" 
                                                data-name="source_type" 
                                                data-title="Enter Source Type" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['source_type']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-time_request_received">
                                        <th class="title"> Time Request Received: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['time_request_received']; ?>" 
                                                data-pk="<?php echo $data['rowid'] ?>" 
                                                data-url="<?php print_link("compute_block_volume_backups/editfield/" . urlencode($data['rowid'])); ?>" 
                                                data-name="time_request_received" 
                                                data-title="Enter Time Request Received" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['time_request_received']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-time_created">
                                        <th class="title"> Time Created: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['time_created']; ?>" 
                                                data-pk="<?php echo $data['rowid'] ?>" 
                                                data-url="<?php print_link("compute_block_volume_backups/editfield/" . urlencode($data['rowid'])); ?>" 
                                                data-name="time_created" 
                                                data-title="Enter Time Created" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['time_created']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-time_destroyed">
                                        <th class="title"> Time Destroyed: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['time_destroyed']; ?>" 
                                                data-pk="<?php echo $data['rowid'] ?>" 
                                                data-url="<?php print_link("compute_block_volume_backups/editfield/" . urlencode($data['rowid'])); ?>" 
                                                data-name="time_destroyed" 
                                                data-title="Enter Time Destroyed" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['time_destroyed']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-unique_size_in_gbs">
                                        <th class="title"> Unique Size In Gbs: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['unique_size_in_gbs']; ?>" 
                                                data-pk="<?php echo $data['rowid'] ?>" 
                                                data-url="<?php print_link("compute_block_volume_backups/editfield/" . urlencode($data['rowid'])); ?>" 
                                                data-name="unique_size_in_gbs" 
                                                data-title="Enter Unique Size In Gbs" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['unique_size_in_gbs']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-last_check">
                                        <th class="title"> Last Check: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['last_check']; ?>" 
                                                data-pk="<?php echo $data['rowid'] ?>" 
                                                data-url="<?php print_link("compute_block_volume_backups/editfield/" . urlencode($data['rowid'])); ?>" 
                                                data-name="last_check" 
                                                data-title="Enter Last Check" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['last_check']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <div class="dropup export-btn-holder mx-1">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-save"></i> Export
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                    <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                        <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                        </a>
                                        <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                        <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                            <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                            </a>
                                            <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                            <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                </a>
                                                <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                    <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                    </a>
                                                    <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                    <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                        <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <!-- Empty Record Message -->
                                            <div class="text-muted p-3">
                                                <i class="fa fa-ban"></i> No Record Found
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
