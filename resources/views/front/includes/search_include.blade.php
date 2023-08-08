<div class="row">


    @inject('centrallog', 'App\CentralLogics\Uservalidation')
    <div class="col-md-4 d-none s_faq" id="s_addby">
        <label>
            Question
        </label>
        <input type="text" id="st_question" class="form-control">
    </div>

    <div class="col-md-4 d-none s_faq s_inq s_groupl s_tax_content s_tag_list s_noti_list s_marcket s_stagetips s_forum_list" id="s_date">
        <label>
            Added Date
        </label>
        <input type="date" id="st_adddate" class="form-control">
    </div>

    <div class="col-md-4 d-none  s_tax_content " id="s_start_date">
        <label>
            Start Date
        </label>
        <input type="date" id="st_start_date" class="form-control">
    </div>

    <div class="col-md-4 d-none s_tax_content " id="s_end_date">
        <label>
            End Date
        </label>
        <input type="date" id="st_end_date" class="form-control">
    </div>

    <div class="col-md-4 d-none s_faq s_tag_list s_stagetips" id="s_type">
        <label>
            Type
        </label>
        <select id="st_type" class="form-control">
            <option value="">Select</option>
            <option value="Category Based">Category Based</option>
            <option value="Genarel">Genarel</option>

        </select>
    </div>

    <div class="col-md-4 d-none s_faq s_inq s_tax_content s_tag_list s_noti_list s_marcket s_stagetips s_forum_list" id="s_addby">

        <label>
            Add By
        </label>
        <select id="st_addby" class="form-control">
            <option value="">Select</option>
            @foreach($centrallog->allusers() as $users)
            <option value="{{$users->id}}">{{$users->first_name}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4 d-none " id="s_createby">
        <label>
            Create By
        </label>
        <input type="text" id="st_createby" class="form-control">
    </div>

    <div class="col-md-4 d-none  " id="s_status">
        <label>
            Status
        </label>
        <select id="st_status " class="form-control">
            <option value="">Select</option>
            <option value="1">Published</option>
            <option value="2">Inactive</option>

        </select>
    </div>

    <div class="col-md-4 d-none s_user_list s_stagetips" id="s_name">
        <label>
            Name
        </label>
        <input type="text" id="st_name" class="form-control">
    </div>

    <div class="col-md-4 d-none s_user_list" id="s_email">
        <label>
            Email
        </label>
        <input type="text" id="st_email" class="form-control">
    </div>

    <div class="col-md-4 d-none s_user_list" id="s_contact">
        <label>
            Contact
        </label>
        <input type="text" id="st_contact" class="form-control">
    </div>
    <div class="col-md-4 d-none s_user_list s_groupl" id="s_group">
        <label>
            Group
        </label>

        <select id="st_group" class="form-control">
            <option value="">Select</option>
            @foreach($centrallog->allgroups() as $group)
            <option value="{{$group->id}}">{{$group->group_name}}</option>
            @endforeach
        </select>

    </div>

    <div class="col-md-4 d-none s_user_list" id="s_nic">
        <label>
            NIC
        </label>
        <input type="text" id="st_nic" class="form-control">
    </div>
    <div class="col-md-4 d-none s_user_list" id="s_address">
        <label>
            Address
        </label>
        <input type="text" id="st_address" class="form-control">
    </div>

    <div class="col-md-4 d-none s_user_list s_groupl s_forum_list" id="s_active_status">
        <label>
            Active Status
        </label>
        <select id="st_active_status" class="form-control">
            <option value="">Select</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>

        </select>
    </div>

    <div class="col-md-4 d-none s_inq" id="s_subject">
        <label>
            Subject
        </label>
        <input type="text" id="st_subject" class="form-control">
    </div>

    <div class="col-md-4 d-none s_inq" id="s_in_status">
        <label>
            Status
        </label>
        <select id="st_in_status" class="form-control">
            <option value="">Select</option>
            <option value="pending">Pending</option>
            <option value="hold">Hold</option>
            <option value="resolved">Resolved</option>

        </select>
    </div>

    <div class="col-md-4 d-none  s_inq" id="s_asignto">

        <label>
            Assigen To
        </label>
        <select id="st_asignto" class="form-control">
            <option value="">Select</option>
            @foreach($centrallog->allusers() as $users)
            <option value="{{$users->id}}">{{$users->first_name}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4 d-none s_tax_content" id="s_heading">
        <label>
            Heading
        </label>
        <input type="text" id="st_heading" class="form-control">
    </div>

    <div class="col-md-4 d-none  s_tax_content" id="s_status_content">
        <label>
            Status
        </label>
        <select id="st_status_content" class="form-control">
            <option value="">Select</option>
            <option value="1">Published</option>
            <option value="0">Inactive</option>

        </select>
    </div>

    <div class="col-md-4 d-none s_tag_list" id="s_tag">
        <label>
            Tag
        </label>
        <input type="text" id="st_tag" class="form-control">
    </div>

    <div class="col-md-4 d-none s_noti_list " id="s_title">
        <label>
            Title
        </label>
        <input type="text" id="st_title" class="form-control">
    </div>

 

    <div class="col-md-4 d-none  s_marcket" id="s_mark_type">

        <label>
            Type
        </label>
        <select id="st_mark_type" class="form-control">
            <option value="">Select</option>
        
        </select>
    </div>

    <div class="col-md-4 d-none s_marcket" id="s_mark_date">
        <label>
            Date
        </label>
        <input type="date" id="st_mark_date" class="form-control">
    </div>

    <div class="col-md-4 d-none s_marcket" id="s_mes_unit">
        <label>
            Measurement Unit
        </label>

        <select id="st_mes_unit" class="form-control">
            <option value="">Select</option>
         
        </select>
    </div>


    <div class="col-md-4 d-none s_forum_list" id="s_topic">
        <label>
            Topic
        </label>
        <input type="text" id="st_topic" class="form-control">
    </div>

    <div class="col-md-4 d-none s_forum_list" id="s_summer">
        <label>
            Summery
        </label>
        <input type="text" id="st_summer" class="form-control">
    </div>

    <!-- <div class="col-md-12">
        <button class="btn btn-danger float-right">Cleare</button>
    </div> -->

</div>