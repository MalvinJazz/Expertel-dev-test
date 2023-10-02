<?php
namespace App\Services;

use App\Models\Meeting;


class MeetingService 
{

    /**
     * 
     *  MODIFY THIS FUNCTION TO YOUR LIKING
     * YOU CAN ADD AS MANY PARAMETERS AS YOU WANT
     * 
     */

    public function scheduleMeeting(Meeting $meeting, $users)
    {

        //check that the meeting doesn't have any conflict
        $meetings = Meeting::whereIn('user_id', $users)
            ->where(function ($query) use ($meeting) {
                $query->whereBetween('start_time', [$meeting->start_time, $meeting->end_time])
                    ->orWhereBetween('end_time', [$meeting->start_time, $meeting->end_time]);
            })
            ->get();

        if (count($meetings)) {
            return false;
        }

        //save the meeting to the database
        foreach ($users as $index => $user_id) {
            $userMeeting = new Meeting();
            $userMeeting->start_time = $meeting->start_time;
            $userMeeting->end_time = $meeting->end_time;
            $userMeeting->meeting_name = $meeting->meeting_name;
            $userMeeting->user_id = $user_id;
            $userMeeting->save();
        }

        return true;
    }
}