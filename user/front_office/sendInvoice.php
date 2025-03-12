<?php
require '../../vendor/autoload.php';

use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set('display_errors', 0);
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['success' => false, 'message' => 'Invalid JSON input']);
        exit;
    }

    $paymentId = $input['paymentId'] ?? '';
    $receiptContent = $input['receiptContent'] ?? '';
    $customerEmail = $input['customerEmail'] ?? '';

    if (!$paymentId || !$receiptContent || !$customerEmail) {
        echo json_encode(['success' => false, 'message' => 'Missing required data']);
        exit;
    }

    try {
        $tempDir = '../../temp/';
        if (!is_dir($tempDir) || !is_writable($tempDir)) {
            echo json_encode(['success' => false, 'message' => 'Temporary directory is not writable']);
            exit;
        }

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($receiptContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfFilePath = $tempDir . 'invoice_' . $paymentId . '.pdf';
        file_put_contents($pdfFilePath, $dompdf->output());

        // Send Email
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'subasethvilla@gmail.com';
        $mail->Password =  'dmbc bjlo nlic favs'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('subasethvilla@gmail.com', 'Subaseth Villa');
        $mail->addAddress($customerEmail);
        $mail->Subject = 'Invoice #' . $paymentId;
        $mail->Body = 'Dear Customer,\n Please find your invoice attached.\n Thanks for choosing us! \n Subaseth Villa Team.';
        $mail->addAttachment($pdfFilePath);

        $mail->send();
        echo json_encode(['success' => true, 'message' => 'Invoice sent successfully']);

        unlink($pdfFilePath);
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage(), 3, '../../logs/error.log');
        echo json_encode(['success' => false, 'message' => 'Mailer Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
