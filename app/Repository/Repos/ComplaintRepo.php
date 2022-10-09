<?php

namespace App\Repository\Repos;

use App\Models\Complaint;
use App\Repository\Interfaces\ComplaintInterface;

class ComplaintRepo implements ComplaintInterface
{
    public function allLatestComplaint()
    {
        return Complaint::latest();
    }
    public function allComplaintList()
    {
        return Complaint::where(['status' => 'active'])->orderBy('name', 'asc')->get();
    }
    public function getAnInstance($complaintId)
    {
        return Complaint::findOrFail($complaintId);
    }
    public function createComplaint($data)
    {
        return Complaint::create($data);
    }
    public function updateComplaint($data, $complaintId)
    {
        $area = $this->getAnInstance($complaintId);
        return $area->update($data);
    }
    public function deleteComplaint($complaintId)
    {
        $area = $this->getAnInstance($complaintId);
        return $area->delete();
    }
}
