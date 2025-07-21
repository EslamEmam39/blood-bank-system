<?php

namespace App\Services;

use App\Models\Client;
use App\Models\DonationRequest;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use Twilio\Rest\Client as TwilioClient;


  class NotificationService 
{
 public function sendDonationRequestNotifications(DonationRequest $donationRequest , array $clientIds){
     

     foreach($clientIds as $clientId){
       $client = Client::findOrFail($clientId);
       if($client){
         $notification = Notification::create([
             'title' => 'طلب تبرع بالدم',                  
              'content' => "مطلوب تبرع بفصيلة {$donationRequest->bloodType->name} للمريض {$donationRequest->patient_name} في {$donationRequest->hospital_name}",
              'donation_request_id' => $donationRequest->id,
              'sent_at' =>Carbon::now(),
         ]);


         $client->notifications()->attach($notification->id , ['is_read'=> false]);

        
         $this->sendEmailNotification($client, $donationRequest);

         $this->sendSMSNotification($client, $donationRequest);    

       }

    }
 } // end 


    private function sendEmailNotification(Client $client, DonationRequest $donationRequest){
         
      try{

        $subject = 'طلب تبرع بالدم';
            $message = "عزيزي {$client->name},\n\n";
            $message .= "يوجد طلب تبرع بالدم يناسب فصيلة دمك:\n";
            $message .= "المريض: {$donationRequest->patient_name}\n";
            $message .= "فصيلة الدم: {$donationRequest->bloodType->name}\n";
            $message .= "المستشفى: {$donationRequest->hospital_name}\n";
            $message .= "العنوان: {$donationRequest->hospital_address}\n";
            $message .= "رقم الهاتف: {$donationRequest->phone}\n\n";
            $message .= "شكراً لك على استعدادك للمساعدة.";

               Mail::raw($message, function ($mail) use ($client, $subject) {
                $mail->to($client->email)
                     ->subject($subject);
            });

      }catch(\Exception $e){
            Log::error('Email notification failed: ' . $e->getMessage());
      }
    


    } //end  
        private function sendSMSNotification(Client $client, DonationRequest $donationRequest)
    {
        try {
            $message = "طلب تبرع بالدم - {$donationRequest->bloodType->name} للمريض {$donationRequest->patient_name} في {$donationRequest->hospital_name}. للتواصل: {$donationRequest->phone}";
            
            // Using a generic SMS API - replace with your preferred SMS service
            // Example with Twilio, Nexmo, or local SMS provider
            $this->sendSMS($client->phone, $message);
        } catch (\Exception $e) {
            Log::error('SMS notification failed: ' . $e->getMessage());
        }
    } //end


  public function sendSMS($phoneNumber, $message)
    {

          try {
        $twilio = new TwilioClient(
             config('services.twilio.sid'),
            config('services.twilio.token')
        );
         
 

        $twilio->messages->create($phoneNumber, [
            'from' => config('services.twilio.phone'),
            'body' => $message
        ]);

        Log::info("✅ SMS sent to {$phoneNumber}");
    } catch (\Exception $e) {
        Log::error("❌ SMS failed: " . $e->getMessage());
    }

              //  Log::info("SMS sent to {$phoneNumber}: {$message}");

    } //end
} 