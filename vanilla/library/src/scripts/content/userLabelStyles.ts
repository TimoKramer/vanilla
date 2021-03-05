/**
 * @copyright 2009-2019 Vanilla Forums Inc.
 * @license GPL-2.0-only
 */

import { globalVariables } from "@library/styles/globalStyleVars";
import { styleFactory, useThemeCache, variableFactory } from "@library/styles/styleUtils";
import { borders, objectFitWithFallback, unit } from "@library/styles/styleHelpers";
import { calc, percent } from "csx";
import { lineHeightAdjustment } from "@library/styles/textUtils";
import { NestedCSSProperties } from "typestyle/lib/types";

export const userLabelVariables = useThemeCache(() => {
    const makeThemeVars = variableFactory("userLabel");
    const globalVars = globalVariables();
    const { mainColors } = globalVars;

    const avatar = makeThemeVars("spacing", {
        size: 40,
        borderRadius: "50%",
        margin: 8,
    });

    const name = makeThemeVars("name", {
        fontSize: globalVars.fonts.size.medium,
        fontWeight: globalVars.fonts.weights.bold,
    });

    return {
        avatar,
        name,
    };
});

export const userLabelClasses = useThemeCache(() => {
    const style = styleFactory("userLabel");
    const globalVars = globalVariables();
    const vars = userLabelVariables();

    const root = style({
        display: "flex",
        flexWrap: "nowrap",
        alignItems: "center",
        justifyContent: "space-between",
        width: percent(100),
        minHeight: unit(vars.avatar.size),
    });

    const fixLineHeight = style("fixLineHeight", {});

    const compact = style("compact", {
        $nest: {
            [`&.${fixLineHeight}`]: lineHeightAdjustment() as NestedCSSProperties,
        },
    });

    const main = style("main", {
        display: "flex",
        flexDirection: "column",
        flexWrap: "nowrap",
        alignItems: "flex-start",
        justifyContent: "space-between",
        width: calc(`100% - ${unit(vars.avatar.size + vars.avatar.margin)}`),
        flexBasis: calc(`100% - ${unit(vars.avatar.size + vars.avatar.margin)}`),
        minHeight: unit(vars.avatar.size),
    });

    const avatar = style("avatar", {
        ...objectFitWithFallback(),
        overflow: "hidden",
        ...borders({
            color: globalVars.mixBgAndFg(0.1),
            width: 1,
            radius: vars.avatar.borderRadius,
        }),
    });
    const avatarLink = style("avatarLink", {
        display: "block",
        position: "relative",
        width: unit(vars.avatar.size),
        height: unit(vars.avatar.size),
        flexBasis: unit(vars.avatar.size),
    });
    const topRow = style("topRow", {});
    const bottomRow = style("bottomRow", {});
    const isCompact = style("isCompact", {});

    const userName = style("userName", {
        $nest: {
            "&&": {
                fontWeight: globalVars.fonts.weights.bold,
                fontSize: unit(globalVars.fonts.size.medium),
                lineHeight: globalVars.lineHeights.condensed,
            },
            [`&&.${isCompact}`]: {
                fontSize: unit(globalVars.fonts.size.small),
            },
        },
    });

    return { root, avatar, avatarLink, topRow, bottomRow, userName, main, compact, isCompact, fixLineHeight };
});
