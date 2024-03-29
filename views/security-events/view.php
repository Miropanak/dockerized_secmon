<?php

use macgyer\yii2materializecss\widgets\data\DetailView;
use yii\helpers\Html;
use app\models\NetworkModel;

/* @var $this yii\web\View */
/* @var $model app\models\SecurityEvents */

$this->params['title'] = 'Security Event ID: ' . $model->id;
$this->params['src_device'] = NetworkModel::getNetworkDevice($model->source_ip_network_model);
$this->params['dst_device'] = NetworkModel::getNetworkDevice($model->destination_ip_network_model);
?>

<div class="main-actions centered-horizontal">
    <?php if ($model->analyzed): ?>
        <?= Html::a("<i class='material-icons' title=\"Show charts\">show_chart</i>" . Yii::t('app', 'Get'), ['show', 'id' => $model->id], ['class' => 'btn-floating waves-effect waves-light btn-large blue'], ['title' =>'Show charts']) ?>
    <?php endif; ?>
    <?= Html::a("<i class='material-icons' title=\"Group events\">group_work</i>" . Yii::t('app', 'Get'), ['analyse', 'id' => $model->id, 'norm' => 'true'], ['class' => 'btn-floating waves-effect waves-light btn-large blue']) ?>
    <?= Html::a("<i class='material-icons' title=\"Search clusters\">filter_alt</i>" . Yii::t('app', 'Get'), ['searchclusters', 'id' => $model->id], ['class' => 'btn-floating waves-effect waves-light btn-large blue']) ?>
</div>

<div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">event</i>Event information</div>
<div class="security-events-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'datetime',
            'type',
            'device_host_name',
            'cef_version',
            'cef_vendor',
            'cef_device_product',
            'cef_device_version',
            'cef_event_class_id',
            'cef_name',
            'cef_severity',
            'message',
            'event_outcome',
            'application_protocol',
            'transport_protocol',
            'external_id',
            'analyzed:boolean',
            'baseEventCount',
            'parent_events:ntext',
            'extensions:ntext',
            'raw_event:ntext',
        ],
    ]) ?>
</div>

<ul class="collapsible">
    <li>
      <div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">network_wifi</i>Source Information: <?= $model->source_address?>:<?= $model->source_port ?></div>
      <div class="collapsible-body">
        <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
            'source_address',
            'source_port',
            'source_mac_address',
            'source_host_name',
            'source_nt_domain',
            'source_dns_domain',
            'source_service_name',
            'source_translated_address',
            'source_translated_port',
            'source_process_id',
            'source_user_privileges',
            'source_process_name',
            'source_user_id',
            'source_user_name',
            'source_group_id',
            'source_group_name',
          ],
        ]) ?>
        <ul class="collapsible">
          <li>
            <div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">public</i>Geolocation information: <?= $model->source_country?></div>
            <div class="collapsible-body"><?= DetailView::widget([
              'model' => $model,
              'attributes' => [
                  'source_code',
                  'source_country',
                  'source_city',
                  'source_latitude',
                  'source_longitude',
              ],
          ]) ?></div>
          </li>
        </ul>
        <ul class="collapsible">
          <li>
            <div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">laptop</i>Network model information: <?= $this->params['src_device']->description?></div>
            <div class="collapsible-body"><?= DetailView::widget([
              'model' => NetworkModel::getNetworkDevice($model->source_ip_network_model),
              'attributes' => [
                  'description', 
                  'hostname',
                  'criticality', 
                  'operation_system', 
                  'open_ports', 
                  'ports', 
                  'services', 
                  'vulnerabilities'
              ],
            ]) ?></div>
          </li>
        </ul>

    </div>
    </li>
  </ul>

  <ul class="collapsible">
    <li>
      <div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">network_wifi</i>Destination Information: <?= $model->destination_address?>:<?= $model->destination_port?></div>
      <div class="collapsible-body">
        <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
            'destination_address',
            'destination_port',
            'destination_mac_address',
            'destination_host_name',
            'destination_nt_domain',
            'destination_dns_domain',
            'destination_service_name',
            'destination_translated_address',
            'destination_translated_port',
            'destination_process_id',
            'destination_user_privileges',
            'destination_process_name',
            'destination_user_id',
            'destination_user_name',
            'destination_group_id',
            'destination_group_name',
          ],
        ]) ?>
        <ul class="collapsible">
          <li>
            <div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">public</i>Geolocation information:<?= $model->destination_country?></div>
            <div class="collapsible-body"><?= DetailView::widget([
              'model' => $model,
              'attributes' => [
                  'destination_code',
                  'destination_country',
                  'destination_city',
                  'destination_geo_latitude',
                  'destination_geo_longitude',
              ],
          ]) ?></div>
          </li>
        </ul>
        <ul class="collapsible">
          <li>
            <div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">laptop</i>Network model information: <?= $this->params['dst_device']->description?></div>
            <div class="collapsible-body"><?= DetailView::widget([
              'model' => NetworkModel::getNetworkDevice($model->destination_ip_network_model),
              'attributes' => [
                  'description', 
                  'hostname',
                  'criticality', 
                  'operation_system', 
                  'open_ports', 
                  'ports', 
                  'services', 
                  'vulnerabilities'
              ],
            ]) ?></div>
          </li>
        </ul>
      </div>
    </li>
  </ul>

  <ul class="collapsible">
    <li>
      <div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">data_usage</i>Data Usage Information</div>
      <div class="collapsible-body"><?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          'bytes_in',
          'bytes_out',
        ],
      ]) ?></div>
    </li>
  </ul>

  <ul class="collapsible">
    <li>
      <div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">devices</i>Device Information</div>
      <div class="collapsible-body"><?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'device_direction',
            'device_dns_domain',
            'device_external_id',
            'device_facility',
            'device_inbound_interface',
            'device_nt_domain',
            'device_outbound_interface',
            'device_payload_id',
            'device_process_name',
            'device_translated_address',
            'device_time_zone',
            'device_address',
            'device_host_name',
            'device_mac_address',
            'device_process_id ',
            'device_action',
            'device_event_category',
        ],
      ]) ?></div>
    </li>
  </ul>

  <ul class="collapsible">
    <li>
      <div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">description</i>File Information</div>
      <div class="collapsible-body"><?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'file_create_time',
            'file_hash',
            'file_id',
            'file_modification_time',
            'file_name',
            'file_path',
            'file_permission',
            'file_size',
            'file_type',
            'old_file_create_time',
            'old_file_hash',
            'old_file_id',
            'old_file_modification_time',
            'old_file_name',
            'old_file_path',
            'old_file_permission',
            'old_file_size',
            'old_file_type',    
        ],
      ]) ?></div>
    </li>
  </ul>

  <ul class="collapsible">
    <li>
      <div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">http</i>Request information</div>
      <div class="collapsible-body"><?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'request_method',
            'request_url',
            'request_context',
            'request_cookies',
            'request_client_application',
        ],
      ]) ?></div>
    </li>
  </ul>

  <ul class="collapsible">
    <li>
      <div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">network_wifi</i>Device Custom IPv6 Address Information</div>
      <div class="collapsible-body"><?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'device_custom_ipv6_address1',
            'device_custom_ipv6_address1_label',
            'device_custom_ipv6_address2',
            'device_custom_ipv6_address2_label',
            'device_custom_ipv6_address3',
            'device_custom_ipv6_address3_label',
            'device_custom_ipv6_address4',
            'device_custom_ipv6_address4_label',
        ],
      ]) ?></div>
    </li>
  </ul>

  <ul class="collapsible">
    <li>
      <div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">pin</i>Device Custom Number Information</div>
      <div class="collapsible-body"><?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'device_custom_floating_point1',
            'device_custom_floating_point1_label',
            'device_custom_floating_point2',
            'device_custom_floating_point2_label',
            'device_custom_floating_point3',
            'device_custom_floating_point3_label',
            'device_custom_floating_point4',
            'device_custom_floating_point4_label',
            'device_custom_number1',
            'device_custom_number1_label',
            'device_custom_number2',
            'device_custom_number2_label',
            'device_custom_number3',
            'device_custom_number3_label',
        ],
      ]) ?></div>
    </li>
  </ul>

  <ul class="collapsible">
    <li>
      <div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">text_fields</i>Device Custom String Information</div>
      <div class="collapsible-body"><?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'device_custom_string1',
            'device_custom_string1_label',
            'device_custom_string2',
            'device_custom_string2_label',
            'device_custom_string3',
            'device_custom_string3_label',
            'device_custom_string4',
            'device_custom_string4_label',
            'device_custom_string5',
            'device_custom_string5_label',
            'device_custom_string6',
            'device_custom_string6_label', 
            'flex_string1',
            'flex_string1_label',
            'flex_string2',
            'flex_string2_label',      
        ],
      ]) ?></div>
    </li>
  </ul>

  <ul class="collapsible">
    <li>
      <div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">calendar_month</i>Device Custom Date Information</div>
      <div class="collapsible-body"><?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'start_time',
            'end_time',
            'device_receipt_time',
            'device_custom_date1',
            'device_custom_date1_label',
            'device_custom_date2',
            'device_custom_date2_label',
            'flex_date1',
            'flex_date1_label',
        ],
      ]) ?></div>
    </li>
  </ul>

  <ul class="collapsible">
    <li>
      <div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">info</i>Zone Key Information</div>
      <div class="collapsible-body"><?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'agent_translated_zone_key',
            'agent_zone_key',
            'device_translated_zone_key',
            'device_zone_key',
            'customer_key',
            'source_translated_zone_key',
            'source_zone_key',
            'destination_translated_zone_key',
            'destination_zone_key',
        ],
      ]) ?></div>
    </li>
  </ul>

  <ul class="collapsible">
    <li>
      <div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">flag_circle</i>Reported Resource Information</div>
      <div class="collapsible-body"><?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'reported_duration',
            'reported_resource_group_name',
            'reported_resource_id',
            'reported_resource_name',
            'reported_resource_type',
        ],
      ]) ?></div>
    </li>
  </ul>
  
  <ul class="collapsible">
    <li>
      <div class="collapsible-header light-blue accent-4" style="font-size:20px; color: white;"><i class="material-icons">security</i>Security Information</div>
      <div class="collapsible-body"><?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'framework_name',
            'threat_actor',
            'threat_attack_id',
            'attack_type',
            'reason',
        ],
      ]) ?></div>
    </li>
  </ul>