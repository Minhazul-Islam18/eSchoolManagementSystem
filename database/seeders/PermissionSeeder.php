<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin panel Permissions
        // Dashboard
        $moduleAppDashboard = Module::updateOrCreate(['name' => 'Admin Dashboard']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppDashboard->id,
            'name' => 'Access Dashboard',
            'slug' => 'app.dashboard',
        ]);

        // Settings
        $moduleAppSettings = Module::updateOrCreate(['name' => 'Settings']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSettings->id,
            'name' => 'Access Settings',
            'slug' => 'app.settings.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSettings->id,
            'name' => 'Update Settings',
            'slug' => 'app.settings.update',
        ]);

        // Profile
        $moduleAppProfile = Module::updateOrCreate(['name' => 'Profile']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProfile->id,
            'name' => 'Update Profile',
            'slug' => 'app.profile.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProfile->id,
            'name' => 'Update Password',
            'slug' => 'app.profile.password',
        ]);

        // Backups
        $moduleAppBackups = Module::updateOrCreate(['name' => 'Backups']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name' => 'Access Backups',
            'slug' => 'app.backups.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name' => 'Create Backups',
            'slug' => 'app.backups.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name' => 'Download Backups',
            'slug' => 'app.backups.download',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name' => 'Delete Backups',
            'slug' => 'app.backups.destroy',
        ]);

        // Role management
        $moduleAppRole = Module::updateOrCreate(['name' => 'Role Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Access Roles',
            'slug' => 'app.roles.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Create Role',
            'slug' => 'app.roles.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Edit Role',
            'slug' => 'app.roles.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Delete Role',
            'slug' => 'app.roles.destroy',
        ]);

        // User management
        $moduleAppUser = Module::updateOrCreate(['name' => 'User Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Access Users',
            'slug' => 'app.users.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Create User',
            'slug' => 'app.users.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Show User',
            'slug' => 'app.users.show',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Edit User',
            'slug' => 'app.users.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Edit User',
            'slug' => 'app.users.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Delete User',
            'slug' => 'app.users.destroy',
        ]);

        // Page management
        $moduleAppPage = Module::updateOrCreate(['name' => 'Page Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Access Pages',
            'slug' => 'app.pages.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Create Page',
            'slug' => 'app.pages.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Edit Page',
            'slug' => 'app.pages.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Delete Page',
            'slug' => 'app.pages.destroy',
        ]);

        // Menu management
        $moduleAppMenu = Module::updateOrCreate(['name' => 'Menu Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => 'Access Menus',
            'slug' => 'app.menus.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => 'Create Menu',
            'slug' => 'app.menus.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => 'Edit Menu',
            'slug' => 'app.menus.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => 'Delete Menu',
            'slug' => 'app.menus.destroy',
        ]);

        // Pricing plan
        $pricingPlan = Module::updateOrCreate(['name' => 'Pricing plan']);
        Permission::updateOrCreate([
            'module_id' => $pricingPlan->id,
            'name' => 'All Plans',
            'slug' => 'app.pricings.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $pricingPlan->id,
            'name' => 'Create plan',
            'slug' => 'app.pricings.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $pricingPlan->id,
            'name' => 'Edit plan',
            'slug' => 'app.pricings.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $pricingPlan->id,
            'name' => 'Delete plan',
            'slug' => 'app.pricings.destroy',
        ]);

        // Transections
        $transections = Module::updateOrCreate(['name' => 'Transections']);
        Permission::updateOrCreate([
            'module_id' => $transections->id,
            'name' => 'View all Transections',
            'slug' => 'app.transections.index',
        ]);

        // School Permissions
        //Dashboard
        $dashboard = Module::updateOrCreate(['name' => 'School dashboard']);
        Permission::updateOrCreate([
            'module_id' => $dashboard->id,
            'name' => 'View dashboard',
            'slug' => 'school.dashboard.index',
        ]);

        //Staff management
        $sm = Module::updateOrCreate(['name' => 'Staff management']);
        Permission::updateOrCreate([
            'module_id' => $sm->id,
            'name' => 'Staff management',
            'slug' => 'school.staffs.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $sm->id,
            'name' => 'Create staff',
            'slug' => 'school.staffs.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $sm->id,
            'name' => 'View staff',
            'slug' => 'school.staffs.show',
        ]);
        Permission::updateOrCreate([
            'module_id' => $sm->id,
            'name' => 'Edit staff',
            'slug' => 'school.staffs.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $sm->id,
            'name' => 'Delete staff',
            'slug' => 'school.staffs.destroy',
        ]);

        //Fee management
        $fm = Module::updateOrCreate(['name' => 'Fee management']);
        Permission::updateOrCreate([
            'module_id' => $fm->id,
            'name' => 'Fee management',
            'slug' => 'school.fees.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $fm->id,
            'name' => 'Create fee',
            'slug' => 'school.fees.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $fm->id,
            'name' => 'Edit fee',
            'slug' => 'school.fees.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $fm->id,
            'name' => 'Delete fee',
            'slug' => 'school.fees.destroy',
        ]);

        //Admission management
        $am = Module::updateOrCreate(['name' => 'Admission management']);
        Permission::updateOrCreate([
            'module_id' => $am->id,
            'name' => 'Admission management',
            'slug' => 'school.admissions.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $am->id,
            'name' => 'Create admission',
            'slug' => 'school.admissions.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $am->id,
            'name' => 'View admission',
            'slug' => 'school.admissions.show',
        ]);
        Permission::updateOrCreate([
            'module_id' => $am->id,
            'name' => 'Edit admission',
            'slug' => 'school.admissions.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $am->id,
            'name' => 'Delete admission',
            'slug' => 'school.admissions.destroy',
        ]);

        //Settings
        $ss = Module::updateOrCreate(['name' => 'School settings']);
        Permission::updateOrCreate([
            'module_id' => $ss->id,
            'name' => 'All settings',
            'slug' => 'school.settings.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $ss->id,
            'name' => 'Change settings',
            'slug' => 'school.settings.update',
        ]);

        //Notice management
        $nm = Module::updateOrCreate(['name' => 'Notice management']);
        Permission::updateOrCreate([
            'module_id' => $nm->id,
            'name' => 'Notice management',
            'slug' => 'school.notices.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $nm->id,
            'name' => 'Create notice',
            'slug' => 'school.notices.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $nm->id,
            'name' => 'Show notice',
            'slug' => 'school.notices.show',
        ]);
        Permission::updateOrCreate([
            'module_id' => $nm->id,
            'name' => 'Update notice',
            'slug' => 'school.notices.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $nm->id,
            'name' => 'Delete notice',
            'slug' => 'school.notices.destroy',
        ]);

        //Grading management
        $gm = Module::updateOrCreate(['name' => 'Grading management']);
        Permission::updateOrCreate([
            'module_id' => $gm->id,
            'name' => 'Grading management',
            'slug' => 'school.gradings.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $gm->id,
            'name' => 'Create grade',
            'slug' => 'school.gradings.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $gm->id,
            'name' => 'Show grade',
            'slug' => 'school.gradings.show',
        ]);
        Permission::updateOrCreate([
            'module_id' => $gm->id,
            'name' => 'Update grade',
            'slug' => 'school.gradings.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $gm->id,
            'name' => 'Delete grade',
            'slug' => 'school.gradings.destroy',
        ]);

        //Grading rule management
        $grm = Module::updateOrCreate(['name' => 'Grading rule management']);
        Permission::updateOrCreate([
            'module_id' => $grm->id,
            'name' => 'Grading rule management',
            'slug' => 'school.grading-rule.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $grm->id,
            'name' => 'Create grading rule',
            'slug' => 'school.grading-rule.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $grm->id,
            'name' => 'Show grading rule',
            'slug' => 'school.grading-rule.show',
        ]);
        Permission::updateOrCreate([
            'module_id' => $grm->id,
            'name' => 'Update grading rule',
            'slug' => 'school.grading-rule.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $grm->id,
            'name' => 'Delete grading rule',
            'slug' => 'school.grading-rule.destroy',
        ]);

        //Class management
        $cm = Module::updateOrCreate(['name' => 'Class management']);
        Permission::updateOrCreate([
            'module_id' => $cm->id,
            'name' => 'Class management',
            'slug' => 'school.classes.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $cm->id,
            'name' => 'Create class',
            'slug' => 'school.classes.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $cm->id,
            'name' => 'Show class',
            'slug' => 'school.classes.show',
        ]);
        Permission::updateOrCreate([
            'module_id' => $cm->id,
            'name' => 'Update class',
            'slug' => 'school.classes.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $cm->id,
            'name' => 'Delete class',
            'slug' => 'school.classes.destroy',
        ]);

        //Class section management
        $csm = Module::updateOrCreate(['name' => 'Class section management']);
        Permission::updateOrCreate([
            'module_id' => $csm->id,
            'name' => 'Class section management',
            'slug' => 'school.sections.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $csm->id,
            'name' => 'Create section',
            'slug' => 'school.sections.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $csm->id,
            'name' => 'Show section',
            'slug' => 'school.sections.show',
        ]);
        Permission::updateOrCreate([
            'module_id' => $csm->id,
            'name' => 'Update section',
            'slug' => 'school.sections.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $csm->id,
            'name' => 'Delete section',
            'slug' => 'school.sections.destroy',
        ]);

        //Class group management
        $cgm = Module::updateOrCreate(['name' => 'Class group management']);
        Permission::updateOrCreate([
            'module_id' => $cgm->id,
            'name' => 'Class group management',
            'slug' => 'school.groups.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $cgm->id,
            'name' => 'Create group',
            'slug' => 'school.groups.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $cgm->id,
            'name' => 'Show group',
            'slug' => 'school.groups.show',
        ]);
        Permission::updateOrCreate([
            'module_id' => $cgm->id,
            'name' => 'Update group',
            'slug' => 'school.groups.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $cgm->id,
            'name' => 'Delete group',
            'slug' => 'school.groups.destroy',
        ]);

        //Subject management
        $subm = Module::updateOrCreate(['name' => 'Subject management']);
        Permission::updateOrCreate([
            'module_id' => $subm->id,
            'name' => 'Subject management',
            'slug' => 'school.subjects.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $subm->id,
            'name' => 'Create subject',
            'slug' => 'school.subjects.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $subm->id,
            'name' => 'Show subject',
            'slug' => 'school.subjects.show',
        ]);
        Permission::updateOrCreate([
            'module_id' => $subm->id,
            'name' => 'Update subject',
            'slug' => 'school.subjects.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $subm->id,
            'name' => 'Delete subject',
            'slug' => 'school.subjects.destroy',
        ]);

        //Routine management
        $rm = Module::updateOrCreate(['name' => 'Routine management']);
        Permission::updateOrCreate([
            'module_id' => $rm->id,
            'name' => 'Routine management',
            'slug' => 'school.routines.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $rm->id,
            'name' => 'Create routine',
            'slug' => 'school.routines.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $rm->id,
            'name' => 'Show routine',
            'slug' => 'school.routines.show',
        ]);
        Permission::updateOrCreate([
            'module_id' => $rm->id,
            'name' => 'Update routine',
            'slug' => 'school.routines.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $rm->id,
            'name' => 'Delete routine',
            'slug' => 'school.routines.destroy',
        ]);

        //Syllabus management
        $sylm = Module::updateOrCreate(['name' => 'Syllabus management']);
        Permission::updateOrCreate([
            'module_id' => $sylm->id,
            'name' => 'syllabus management',
            'slug' => 'school.syllabi.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $sylm->id,
            'name' => 'Create syllabus',
            'slug' => 'school.syllabi.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $sylm->id,
            'name' => 'Show syllabus',
            'slug' => 'school.syllabi.show',
        ]);
        Permission::updateOrCreate([
            'module_id' => $sylm->id,
            'name' => 'Update syllabus',
            'slug' => 'school.syllabi.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $sylm->id,
            'name' => 'Delete syllabus',
            'slug' => 'school.syllabi.destroy',
        ]);

        //Exam management
        $exmm = Module::updateOrCreate(['name' => 'Exam management']);
        Permission::updateOrCreate([
            'module_id' => $exmm->id,
            'name' => 'Exam management',
            'slug' => 'school.exams.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $exmm->id,
            'name' => 'Create exam',
            'slug' => 'school.exams.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $exmm->id,
            'name' => 'Show exam',
            'slug' => 'school.exams.show',
        ]);
        Permission::updateOrCreate([
            'module_id' => $exmm->id,
            'name' => 'Update exam',
            'slug' => 'school.exams.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $exmm->id,
            'name' => 'Delete exam',
            'slug' => 'school.exams.destroy',
        ]);


        //Exam result management
        $exmrm = Module::updateOrCreate(['name' => 'Exam result management']);
        Permission::updateOrCreate([
            'module_id' => $exmrm->id,
            'name' => 'Exam result management',
            'slug' => 'school.exam-results.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $exmrm->id,
            'name' => 'Create result',
            'slug' => 'school.exam-results.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $exmrm->id,
            'name' => 'Show result',
            'slug' => 'school.exam-results.show',
        ]);
        Permission::updateOrCreate([
            'module_id' => $exmrm->id,
            'name' => 'Update result',
            'slug' => 'school.exam-results.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $exmrm->id,
            'name' => 'Delete result',
            'slug' => 'school.exam-results.destroy',
        ]);

        //Attendance management
        $exmrm = Module::updateOrCreate(['name' => 'Attendance management']);
        Permission::updateOrCreate([
            'module_id' => $exmrm->id,
            'name' => 'Attendance management',
            'slug' => 'school.attendance.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $exmrm->id,
            'name' => 'Create result',
            'slug' => 'school.attendance.create',
        ]);

        //Fee collection management
        $fcm = Module::updateOrCreate(['name' => 'Fee collection management']);
        Permission::updateOrCreate([
            'module_id' => $fcm->id,
            'name' => 'Fee collection management',
            'slug' => 'school.fee-collection.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $fcm->id,
            'name' => 'Save fee data',
            'slug' => 'school.fee-collection.update',
        ]);
    }
}
