<?php
    include 'includes/session.php';

    function generateRow($conn) {
        $contents = '';

        $sql = "SELECT * FROM positions ORDER BY priority ASC";
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {
            $id = $row['id'];
            $contents .= '
                <tr>
                    <td colspan="2" align="center" style="font-size:15px;"><b>' . htmlspecialchars($row['description']) . '</b></td>
                </tr>
                <tr>
                    <td width="80%"><b>Candidates</b></td>
                    <td width="20%"><b>Votes</b></td>
                </tr>
            ';

            $sql = "SELECT * FROM candidates WHERE position_id = ? ORDER BY lastname ASC";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $cquery = $stmt->get_result();

            while ($crow = $cquery->fetch_assoc()) {
                $sql = "SELECT COUNT(*) as vote_count FROM votes WHERE candidate_id = ?";
                $vstmt = $conn->prepare($sql);
                $vstmt->bind_param('i', $crow['id']);
                $vstmt->execute();
                $vquery = $vstmt->get_result();
                $votes = $vquery->fetch_assoc()['vote_count'];

                $contents .= '
                    <tr>
                        <td>' . htmlspecialchars($crow['lastname']) . ", " . htmlspecialchars($crow['firstname']) . '</td>
                        <td>' . $votes . '</td>
                    </tr>
                ';
            }
        }

        return $contents;
    }

    $parse = parse_ini_file('config.ini', false, INI_SCANNER_RAW);
    $title = htmlspecialchars($parse['election_title']);

    require_once('C:\Users\HP\Desktop\xampp\htdocs\votesystem\tcpdf\tcpdf\tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Result: ' . $title);  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);  
    $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(true, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();  
    $content = '';  
    $content .= '
        <h2 align="center">' . $title . '</h2>
        <h4 align="center">Tally Result</h4>
        <table border="1" cellspacing="0" cellpadding="3">  
    ';  
    $content .= generateRow($conn);  
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('election_result.pdf', 'I');
?>
