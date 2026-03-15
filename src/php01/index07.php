<?php

/**
 * NCPに基づいた栄養診断生成関数
 */
function ncpDiagnosis($data)
{
    // --- 1. アセスメントデータの整理 ---
    $energy_ratio = ($data['dinner_kcal'] / $data['daily_kcal']) * 100;
    $bmi = $data['weight'] / (($data['height'] / 100) ** 2);
    
    // --- 2. 栄養診断（PES）のロジック ---
    // P (Problem): エネルギー摂取過剰（NI-1.3）
    // E (Etiology): 夕食への過度なエネルギー・糖質集中
    // S (Signs/Symptoms): 夕食配分40%以上、BMIの増加、HbA1cの高値など

    $diagnosis = [];

    // 夕食配分40%以上を「症状・徴候」としてキャッチ
    if ($energy_ratio >= 40.0) {
        $diagnosis['P'] = "エネルギー摂取過剰 (NI-1.3)";
        $diagnosis['E'] = "夜間のBMAL1活性およびDIT低下を考慮しない夕食への食事集中";
        $diagnosis['S'] = "夕食エネルギー配分比率 " . round($energy_ratio, 1) . "%（基準値 40%以上）";
        
        // ガイドラインに基づいた根拠（肉付け）
        $diagnosis['Evidence'] = "日本肥満学会 肥満症診療ガイドラインおよびBMAL1の生理学的機序に基づく";
    }

    return $diagnosis;
}

// --- 3. 対象者に合わせた「言葉の出力」制御 ---
function getInstructionMaterial($diagnosis, $target_type) 
{
    if (empty($diagnosis)) return "特に問題は認められません。";

    // プロ向け（カルテ記載用）と対象者向け（指導箋用）で漢字や柔らかさを変える
    if ($target_type === 'professional') {
        return "【PES】{$diagnosis['P']}：{$diagnosis['E']}に関連した、{$diagnosis['S']}によって示される。";
    } else {
        // 対象者向け：漢字を減らし、言葉を柔らかく
        return "夜のごはんの量が、1日の「40%」を超えているようです。夜は体がエネルギーを蓄えやすい時間帯なので、少しお昼に分けてみませんか？";
    }
}

// 実行例
$myAssessment = [
    'daily_kcal' => 2000,
    'dinner_kcal' => 900, // 45%
    'weight' => 75,
    'height' => 170
];

$result = ncpDiagnosis($myAssessment);

echo "■ 医療職向け記録：\n" . getInstructionMaterial($result, 'professional') . "\n\n";
echo "■ 対象者向け資料：\n" . getInstructionMaterial($result, 'patient');