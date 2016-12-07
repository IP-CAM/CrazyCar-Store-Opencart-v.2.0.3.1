<?php 
class ModelTotalPaycharge extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
		if ($this->config->get('paycharge_status') && isset($this->session->data['payment_method']['code']) && $this->cart->getSubTotal()) {
			foreach ($this->config->get('paycharge') as $paycharge) {
				if ($paycharge['payment_method'] == $this->session->data['payment_method']['code']) {
					
					$payment_fees = 0;
					if (strpos($this->session->data['shipping_method']['title'],'CAI')!== false)
						$payment_fees = 5;
					else if (strpos($this->session->data['shipping_method']['title'],'ALX')!== false)
						$payment_fees = 5;
					else if (strpos($this->session->data['shipping_method']['title'],'Region_2')!== false)
						$payment_fees = 40;
					else if (strpos($this->session->data['shipping_method']['title'],'Region_3')!== false)
						$payment_fees = 60;
					else
						$payment_fees = 60;
					
					$total_data[] = array(
						'code'       => 'paycharge',
						//'title'      => $paycharge['description'][$this->config->get('config_language_id')]['name'] . ' (' . $paycharge['valuep'] . '%' . ')',
						//'title'      => $paycharge['description'][$this->config->get('config_language_id')]['name'] . ' (' . $paycharge['valuep'] . ')',
						'title'      => $paycharge['description'][$this->config->get('config_language_id')]['name'],
        				//'value'      => ($total / 100 * $paycharge['valuep']),
        				//'value'      => $paycharge['valuep'],
						'value'      => $payment_fees,
						'sort_order' => $this->config->get('paycharge_sort_order')
					);

					//$total += ($total / 100 * $paycharge['valuep']);
					//$total +=  $paycharge['valuep'];
					$total +=  $payment_fees;
				}
			}
		}
	}
}