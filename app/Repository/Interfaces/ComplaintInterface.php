<?php

namespace App\Repository\Interfaces;

interface ComplaintInterface
{
    public function allLatestComplaint();
    public function allComplaintList();
    public function getAnInstance($complaintId);
    public function createComplaint(array $data);
    public function updateComplaint(array $data, $complaintId);
    public function deleteComplaint($complaintId);
}
