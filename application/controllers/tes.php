<?php
if ($this->form_validation->run() == true) {
    $insertCount = $updateCount = $rowCount = $notAddCount = 0;

    // If file uploaded
    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        // Load CSV reader library
        $this->load->library('CSVReader');

        // Parse data from CSV file
        $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

        // Insert/update CSV data into database
        if (!empty($csvData)) {
            foreach ($csvData as $row) {
                $rowCount++;

                // Prepare data for DB insertion
                $memData = array(
                    'name' => $row['Name'],
                    'email' => $row['Email'],
                    'phone' => $row['Phone'],
                    'status' => $row['Status'],
                );

                // Check whether email already exists in the database
                $con = array(
                    'where' => array(
                        'email' => $row['Email']
                    ),
                    'returnType' => 'count'
                );
                $prevCount = $this->member->getRows($con);

                if ($prevCount > 0) {
                    // Update member data
                    $condition = array('email' => $row['Email']);
                    $update = $this->member->update($memData, $condition);

                    if ($update) {
                        $updateCount++;
                    }
                } else {
                    // Insert member data
                    $insert = $this->member->insert($memData);

                    if ($insert) {
                        $insertCount++;
                    }
                }
            }

            // Status message with imported data count
            $notAddCount = ($rowCount - ($insertCount + $updateCount));
            $successMsg = 'Members imported successfully. Total Rows (' . $rowCount . ') | Inserted (' . $insertCount . ') | Updated (' . $updateCount . ') | Not Inserted (' . $notAddCount . ')';
            $this->session->set_userdata('success_msg', $successMsg);
        }
    } else {
        $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
    }
}
