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
                    <h4 class="record-title">View  Compute Boot Volumes</h4>
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
                                    <tr  class="td-availability_domain">
                                        <th class="title"> Availability Domain: </th>
                                        <td class="value"> <?php echo $data['availability_domain']; ?></td>
                                    </tr>
                                    <tr  class="td-compartment_id">
                                        <th class="title"> Compartment Id: </th>
                                        <td class="value"> <?php echo $data['compartment_id']; ?></td>
                                    </tr>
                                    <tr  class="td-boot_volume_id">
                                        <th class="title"> Boot Volume Id: </th>
                                        <td class="value"> <?php echo $data['boot_volume_id']; ?></td>
                                    </tr>
                                    <tr  class="td-instance_id">
                                        <th class="title"> Instance Id: </th>
                                        <td class="value"> <?php echo $data['instance_id']; ?></td>
                                    </tr>
                                    <tr  class="td-lifecycle_state">
                                        <th class="title"> Lifecycle State: </th>
                                        <td class="value"> <?php echo $data['lifecycle_state']; ?></td>
                                    </tr>
                                    <tr  class="td-time_created">
                                        <th class="title"> Time Created: </th>
                                        <td class="value"> <?php echo $data['time_created']; ?></td>
                                    </tr>
                                    <tr  class="td-time_destroyed">
                                        <th class="title"> Time Destroyed: </th>
                                        <td class="value"> <?php echo $data['time_destroyed']; ?></td>
                                    </tr>
                                    <tr  class="td-last_check">
                                        <th class="title"> Last Check: </th>
                                        <td class="value"> <?php echo $data['last_check']; ?></td>
                                    </tr>
                                    <tr  class="td-compute_compid">
                                        <th class="title"> Compute Compid: </th>
                                        <td class="value"> <?php echo $data['compute_compid']; ?></td>
                                    </tr>
                                    <tr  class="td-compute_display_name">
                                        <th class="title"> Compute Display Name: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['compute_display_name']; ?>" 
                                                data-pk="<?php echo $data['rowid'] ?>" 
                                                data-url="<?php print_link("compute/editfield/" . urlencode($data['rowid'])); ?>" 
                                                data-name="display_name" 
                                                data-title="Enter Display Name" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['compute_display_name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-compute_id">
                                        <th class="title"> Compute Id: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['compute_id']; ?>" 
                                                data-pk="<?php echo $data['rowid'] ?>" 
                                                data-url="<?php print_link("compute/editfield/" . urlencode($data['rowid'])); ?>" 
                                                data-name="id" 
                                                data-title="Enter Id" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['compute_id']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-compute_lifecycle_state">
                                        <th class="title"> Compute Lifecycle State: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['compute_lifecycle_state']; ?>" 
                                                data-pk="<?php echo $data['rowid'] ?>" 
                                                data-url="<?php print_link("compute/editfield/" . urlencode($data['rowid'])); ?>" 
                                                data-name="lifecycle_state" 
                                                data-title="Enter Lifecycle State" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['compute_lifecycle_state']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-compute_time_created">
                                        <th class="title"> Compute Time Created: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['compute_time_created']; ?>" 
                                                data-pk="<?php echo $data['rowid'] ?>" 
                                                data-url="<?php print_link("compute/editfield/" . urlencode($data['rowid'])); ?>" 
                                                data-name="time_created" 
                                                data-title="Enter Time Created" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['compute_time_created']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-compute_time_destroyed">
                                        <th class="title"> Compute Time Destroyed: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['compute_time_destroyed']; ?>" 
                                                data-pk="<?php echo $data['rowid'] ?>" 
                                                data-url="<?php print_link("compute/editfield/" . urlencode($data['rowid'])); ?>" 
                                                data-name="time_destroyed" 
                                                data-title="Enter Time Destroyed" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['compute_time_destroyed']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-compute_last_check">
                                        <th class="title"> Compute Last Check: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['compute_last_check']; ?>" 
                                                data-pk="<?php echo $data['rowid'] ?>" 
                                                data-url="<?php print_link("compute/editfield/" . urlencode($data['rowid'])); ?>" 
                                                data-name="last_check" 
                                                data-title="Enter Last Check" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['compute_last_check']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-compute_adname">
                                        <th class="title"> Compute Availability Domain Name: </th>
                                        <td class="value"> <?php echo $data['compute_adname']; ?></td>
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
