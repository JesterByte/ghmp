<?php

namespace App\Controllers;

use App\Helpers\EmailHelper;
use App\Models\BadgeModel;
use App\Models\DeceasedModel;
use App\Models\UserModel;
use App\Core\View;
use App\Helpers\DisplayHelper;
use App\Models\InquiriesModel;
use App\Utils\Formatter;

class InquiriesController extends BaseController {
    public function index() {
        $this->checkSession();

        $inquiriesModel = new InquiriesModel();
        $inquiriesTable = $inquiriesModel->getInquiries();

        $data = [
            "pageTitle" => "Inquiries",
            "usesDataTables" => true,
            "inquiriesTable" => $inquiriesTable,
            "view" => "inquiries/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function reply()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $inquiryId = $_POST["inquiry_id"];
                $recipientEmail = $_POST['recipient_email'];
                $subject = $_POST['subject'];
                $message = $_POST['message'];
                
                $emailHelper = new EmailHelper();
                
                // Create HTML email template with better styling
                $htmlBody = "
                    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px;'>
                        <!-- Header with Logo -->
                        <div style='text-align: center; padding: 20px 0; background-color: #004d40; margin-bottom: 20px;'>
                            <h1 style='color: #ffffff; margin: 0;'>Green Haven Memorial Park</h1>
                        </div>
                        
                        <!-- Main Content -->
                        <div style='padding: 20px; border: 1px solid #e0e0e0; border-radius: 8px; background-color: #f8f9fa;'>
                            <h2 style='color: #004d40; margin-bottom: 20px;'>Response to Your Inquiry</h2>
                            
                            <div style='line-height: 1.6; color: #333333; background-color: #ffffff; padding: 20px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>
                                {$message}
                            </div>
                        </div>
                        
                        <!-- Footer -->
                        <div style='margin-top: 30px; padding-top: 20px; border-top: 1px solid #e0e0e0;'>
                            <p style='color: #666666; margin-bottom: 10px;'>Best regards,</p>
                            <p style='color: #004d40; font-weight: bold; margin: 0;'>Green Haven Memorial Park</p>
                        </div>
                    </div>
                ";

                // Plain text version remains the same
                $plainText = strip_tags($message) . "\n\nBest regards,\nGreen Haven Memorial Park";

                if ($emailHelper->sendEmail($recipientEmail, $subject, $htmlBody, $plainText)) {
                    // Update inquiry status in database
                    $inquiriesModel = new InquiriesModel();
                    $inquiriesModel->readInquiry($inquiryId);

                    $this->redirect(BASE_URL . '/inquiries', DisplayHelper::$checkIcon, 'Reply sent successfully', "Operation Successful");
                } else {
                    throw new \Exception('Email failed to send');
                }
            } catch (\Exception $e) {
                $this->redirect(BASE_URL .  '/inquiries', DisplayHelper::$xIcon, 'Failed to send reply: ' . $e->getMessage(), 'Operation Failed');
            }
        }
    }
}