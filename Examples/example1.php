<?php
//before clean code
public function resetActions(Request $request)
{
    if (auth()->user()->is_admin()) {
        $type = $request->input('type');
        if ($type == 'login') {
            ResetAllLoginActions::dispatch();
        } else {
            if ($type == 'upload') {
                ResetUploadActions::dispatch();
            } else {
                if ($type == 'action') {
                    ResetAllActions::dispatch();
                } else {
                    if ($type == 'purge_older_actions') {
                        PurgeOldActionJob::dispatchNow();
                    }
                }
            }
        }
        return back()->with('status', 'All ' . $type . ' Job action will be reset soon!');
    } else {
        return back()->withMessage('You are not authorized!');
    }
}


//after clean code
function resetActions(Request $request)
{
    if (!auth()->user()->is_admin()) {
        return back()->withMessage('You are not authorized!');
    }

    $type = $request->input('type');
    switch ($type) {
        case 'login':
            ResetAllLoginActions::dispatch();
            break;
        case 'upload':
            ResetUploadActions::dispatch();
            break;
        case 'action':
            ResetAllActions::dispatch();
            break;
        case 'purge_older_actions':
            PurgeOldActionJob::dispatchNow();

    }
    return back()->with('status', 'All ' . $type . ' Job action will be reset soon!');
}

?>