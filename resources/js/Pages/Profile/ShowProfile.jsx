import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage } from '@inertiajs/react';
import { useState } from 'react';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm';

export default function ShowProfile({ mustVerifyEmail, status }) {
    const { user } = usePage().props.auth;
    const [isEditing, setIsEditing] = useState(false);

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Profile
                </h2>
            }
        >
            <Head title="Profile" />

            <div className="py-12">
                <div className="mx-auto max-w-3xl sm:px-6 lg:px-8">
                    <div className="bg-white shadow sm:rounded-lg p-6">
                        {!isEditing ? (
                            <div className="space-y-4">
                                <div>
                                    <p className="text-sm font-medium text-gray-700">Name</p>
                                    <p className="text-lg text-gray-900">{user.name}</p>
                                </div>
                                <div>
                                    <p className="text-sm font-medium text-gray-700">Email</p>
                                    <p className="text-lg text-gray-900">{user.email}</p>
                                </div>
                                <div>
                                    <p className="text-sm font-medium text-gray-700">Phone</p>
                                    <p className="text-lg text-gray-900">{user.phone || '—'}</p>
                                </div>
                                <div>
                                    <p className="text-sm font-medium text-gray-700">Bio</p>
                                    <p className="text-lg text-gray-900">{user.bio || '—'}</p>
                                </div>

                                {/* <button
                                    onClick={() => setIsEditing(true)}
                                    className="mt-4 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700"
                                >
                                    Edit
                                </button> */}
                            </div>
                        ) : (
                            <UpdateProfileInformationForm
                                mustVerifyEmail={mustVerifyEmail}
                                status={status}
                                className="max-w-xl"
                            />
                        )}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
