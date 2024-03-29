<?php


namespace App\Transactions\Providers;


use App\Transactions\Exceptions\StatusNotFoundException;
use App\Transactions\ProviderAbstract;
use Carbon\Carbon;

class DataProviderX extends ProviderAbstract
{
    const  PROVIDER_AUTHORISED_STATUS = 1;
    const  PROVIDER_DECLINE_STATUS = 2;
    const  PROVIDER_REFUNDED_STATUS = 3;
    /**
     * @throws StatusNotFoundException
     */
    public function run()
    {

            $this->balance = $this->data['parentAmount'];
            $this->currency = $this->data['Currency'];
            $this->provider = class_basename(self::class);
            $this->created_at = Carbon::createFromFormat('Y-m-d',$this->data['registerationDate']);
            $this->id = $this->data['parentIdentification'];
            switch ($this->data['statusCode'])
            {
                case self::PROVIDER_AUTHORISED_STATUS:
                    $this->status = parent::AUTHORISED_STATUS;
                    break;
                case self::PROVIDER_DECLINE_STATUS:
                    $this->status = parent::DECLINE_STATUS;
                    break;
                case self::PROVIDER_REFUNDED_STATUS:
                    $this->status = parent::REFUNDED_STATUS;
                    break;
                default:
                    throw new StatusNotFoundException;
            }

    }

}
