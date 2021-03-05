/**
 * @copyright 2009-2019 Vanilla Forums Inc.
 * @license GPL-2.0-only
 */

import * as React from "react";
import { t } from "@library/utility/appUtils";
import { uniqueIDFromPrefix } from "@library/utility/idUtils";
import DocumentTitle from "@library/routing/DocumentTitle";
import PasswordForm from "@dashboard/pages/authenticate/components/PasswordForm";

export default class PasswordPage extends React.Component {
    private id = uniqueIDFromPrefix("PasswordPage");

    get titleID(): string {
        return this.id + "-pageTitle";
    }

    public render() {
        return (
            <div className="authenticateUserCol">
                <DocumentTitle title={t("Sign In")}>
                    <h1 id={this.titleID} className="isCentered">
                        {t("Sign In")}
                    </h1>
                </DocumentTitle>
                <PasswordForm />
            </div>
        );
    }
}
