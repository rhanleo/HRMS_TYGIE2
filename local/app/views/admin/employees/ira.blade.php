<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>FORM IR8A</title>

	<style>

		.container {
			width: 960px;
			margin: 0 auto;
			display: block;
		}

		table {
			width: 100%;
			border-width: 0;
			border-spacing: 0;
			padding: 0;
			font: 12px/20px sans-serif;
			border-collapse: collapse;
		}

		.vam {
			vertical-align: middle;
		}

		.tc {
			text-align: center;
		}

		.tw {
			color: #fff;
		}

		.p5 {
			padding: 5px;
		}

		.bb {
			border: 1px solid #151515;
		}

		.fs10 {
			font-size: 10px;
		}

		.mt0 {
			margin-top: 0;
		}

		.mt10 {
			margin-top: 10px;
		}

		.mb5 {
			margin-bottom: 5px;
		}

		.mb0 {
			margin-bottom: 0;
		}

		.m0 {
			margin: 0;
		}

		@media print {
			.page-break {
				page-break-before: always;
			}

			.page-break tr {
				page-break-inside: avoid;
			}
		}

	</style>

</head>
<body>

<div class="container">
	<table>
		<tr>
			<td width="4%"><h1>2016</h1></td>
			<td width="96%" class="vam tc"><h1>FORM IR8A</h1></td>
		</tr>
	</table>
	<table>
		<tr>
			<td bgcolor="#151515" class="vam tc"><p class="tw" style="margin: 10px;"><b>Return of Employee’s Remuneration for the Year Ended 31 Dec 2015<br>Fill in this form and give it to your employee by 1 Mar 2016 for his submission together with his Income Tax Return</b></p></td>
		</tr>
		<tr>
			<td>
				<p><b>This Form will take about 10 minutes to complete. Please get ready the employee’s personal particulars and details of his/her employment income. Please read the explanatory notes when completing this form.</b></p>
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<td class="bb p5">
				<p class="fs10 mt0 mb5">Employer’s Tax Ref. No. / UEN</p>
				<input style="width:95%" type="text">
			</td>
			<td class="bb p5" colspan="3">
				<p class="fs10 mt0 mb5">Employee’s Tax Ref. No. : *NRIC / FIN (Foreign Identification No.)</p>
				<input style="width:95%" type="text" value="{{$employee->nric}}">
			</td>
		</tr>
		<tr>
			<td class="bb p5">
				<p class="fs10 mt0 mb5">Full Name of Employee as per NRIC / FIN</p>
				<input style="width:95%" type="text" value="{{$employee->fullName}}">
			</td>
			<td class="bb p5">
				<p class="fs10 mt0 mb5">Date of Birth</p>
				<input style="width:95%" type="text" value="{{$employee->date_of_birth}}">
			</td>
			<td class="bb p5">
				<p class="fs10 mt0 mb5">Sex</p>
				<input style="width:95%" type="text" value="{{$employee->gender}}">
			</td>
			<td class="bb p5">
				<p class="fs10 mt0 mb5">Nationality</p>
				<input style="width:95%" type="text">
			</td>
		</tr>
		<tr>
			<td class="bb p5">
				<p class="fs10 mt0 mb5">Residential Address</p>
				<input style="width:95%" type="text" value="{{$employee->localAddress}}">
			</td>
			<td class="bb p5">
				<p class="fs10 mt0 mb5">Designation</p>
				<input style="width:95%" type="text" value="{{$designation->designation}}">
			</td>
			<td class="bb p5" colspan="2">
				<p class="fs10 mt0 mb5">Bank to which salary is credited</p>
				<input style="width:95%" type="text" value="{{$bank->bank}}">
			</td>
		</tr>
		<tr>
			<td class="bb p5">
				<p class="fs10 mt0 mb5">If employment commenced and/or ceased during the year, state:</p>
				<p class="mt0 mb5"><b class="fs10">(See Explanatory Note 7)</b><input style="width: 150px; margin-left: 5px;" type="text" value="{{$employee->exit_date}}"></p>
			</td>
			<td class="bb p5">
				<p class="fs10 mt0 mb5">Date of Commencement</p>
				<input style="width:95%" type="text" value="{{$employee->joiningDate}}">
			</td>
			<td class="bb p5" colspan="2">
				<p class="fs10 mt0 mb5">Date of *Cessation/Overseas Posting</p>
				<input style="width:95%" type="text">
			</td>
		</tr>
		<tr>
			<td bgcolor="#151515" colspan="3" class="bb p5"><p class="tw m0">INCOME (Enter “NA” for items that are not applicable)</p></td>
			<td bgcolor="#151515" class="p5 bb vam tc"><p class="tw m0">$</p></td>
		</tr>
	</table>
	<table>
		<tr>
			<td><p class="mb0">a)</p></td>
			<td><p class="mb0"><b>Gross Salary, Fees, Leave Pay, Wages and Overtime Pay (See Explanatory Note 12a)</b></p></td>
			<td align="right"><p class="mb0"><input type="text"></p></td>
		</tr>
		<tr>
			<td><p class="mb0">b)</p></td>
			<td><p class="mb0"><b>Bonus</b> (non-contractual bonus paid in 2015 and / or contractual bonus) <b>(See Explanatory Note 12b)</b></p></td>
			<td align="right"><p class="mb0"><input type="text"></p></td>
		</tr>
		<tr>
			<td><p class="mb0">c)</p></td>
			<td>
				<p class="mb0"><b>Director’s fees </b> (approved at the company’s AGM/EGM on <input style="width: 20px;" type="text"> / <input style="width: 20px;" type="text"> / 2015)<b> (See Explanatory Note 12c)</b>
				</p>
			</td>
			<td align="right"><p class="mb0"><input type="text"></p></td>
		</tr>
		<tr>
			<td><p class="mb0">d)</p></td>
			<td><p class="mb0" colspan="2"><b>Others:</b></p></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><p class="mb0" colspan="2">1. Allowances: (i) Transport: $<input style="width: 20px; margin-right: 10px;" type="text"> (ii) Entertainment $<input style="width: 20px; margin-right: 10px;" type="text"> (iii) Others $<input style="width: 20px; margin-right: 10px;" type="text"><b>[See Explanatory Note 12d(I)]</b></p></td>
			<td align="right"><p class="mb0"><input type="text"></p></td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td><p class="mb0" colspan="2">2. Gross Commission for the period <input style="width: 20px;" type="text"> to <input style="width: 20px; margin-right: 80px;" type="text"> * Monthly/other than monthly payment</p></td>
			<td align="right"><p class="mb0"><input type="text"></p></td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td><p class="mb0" colspan="2">3. Pension</p></td>
			<td align="right"><p class="mb0"><input type="text"></p></td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td>
				<p class="mb0" colspan="2">4. Lump sum payment <b>[See Explanatory Note 12d (II)]</b></p>
			</td>
			<td align="right"><p class="mb0"><input type="text"></p></td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td colspan="2">
				<table style="margin-top: 10px;">
					<tr>
						<td class="bb p5">
							<p class="m0">(i) Gratuity $ <input style="width: 160px;" type="text"></p>
						</td>
						<td class="bb p5">
							<p class="m0">(ii) Notice Pay $ <input style="width: 160px;" type="text"></p>
						</td>
						<td class="bb p5">
							<p class="m0">(iii) Ex-gratia payment $ <input style="width: 160px;" type="text"></p>
						</td>
					</tr>
					<tr>
						<td colspan="3" class="bb p5">
							<p class="m0">(iv) Others (please state nature) $ <input style="width: 160px;" type="text"></p>
						</td>
					</tr>
					<tr>
						<td colspan="3" class="bb p5">
							<p class="m0">(v) Compensation for loss of office $ <input style="width: 160px; margin-right: 40px;" type="text"><span style="margin-right: 40px;">Approval obtained from IRAS: *Yes/No</span> Date of approval: <input style="width: 160px;" type="text"></p>
						</td>
					</tr>
					<tr>
						<td class="bb p5" colspan="2">
							<p class="m0"><b>Reason for payment:</b> <input style="width: 420px;" type="text"></p>
						</td>
						<td class="bb p5">
							<p class="m0"><b>Length of service:</b> <input style="width: 160px;" type="text"></p>
						</td>
					</tr>
					<tr>
						<td class="bb p5" colspan="3">
							<p class="m0"><b>Basis of arriving at the payment:</b> <input style="width: 410px; margin-right: 20px;" type="text"> (Give details separately if space is insufficient)</p>
						</td>
					</tr>	
				</table>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<p class="mb0" colspan="2">5. Retirement benefits including gratuities/pension/commutation of pension/lump sum payments, etc from</p>
				<table style="mt0">
					<tr>
						<td style="padding: 5px 5px 5px 13px;">Pension/Provident Fund: Name of Fund <input type="text" style="width: 50px;"></td>
					</tr>
					<tr>
						<td style="padding: 5px 5px 5px 13px;">(Amount accrued up to 31 Dec 1992 $ <input type="text" style="width: 50px;">)</td>
						<td style="padding: 5px 5px 5px 13px;">Amount accrued from 1993: <input type="text" style="width: 50px;"></td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td>
				<p class="mb0 mt0" colspan="2">6. Contributions made by employer to any Pension/Provident Fund constituted outside Singapore <u>without</u> tax concession:</p>
			</td>
			<td align="right"><p class="mt0 mb0"><input type="text"></p></td>
		</tr>

		<tr>
			<td></td>
			<td colspan="2">
				<p class="mb5" style="margin-left: 13px;">Contributions made by employer to any Pension/Provident Fund constituted outside Singapore <u>with</u> tax concession:</p>
				<table class="mt0" style="margin-left: 13px;">
					<tr>
						<td class="bb p5" colspan="2">Name of the overseas pension/provident fund: <input type="text" style="width: 500px;"></td>
					</tr>
					<tr>
						<td class="bb p5">Full Amount of the contributions: <input type="text" style="width: 240px;"></td>
						<td class="bb p5">Are contributions mandatory?: *Yes/No</td>
					</tr>
					<tr>
						<td class="bb p5" colspan="2">Were contributions charged / deductions claimed by a Singapore permanent establishment.? *Yes/No</td>
					</tr>
				</table>
				<p style="margin: 10px 0 10px 13px;"><b>[See Explanatory Note 12d (III)]</b></p>
			</td>
		</tr>
		</table>
		<table class="page-break">
		<tr>
			<td>&nbsp;</td>
			<td>
				<p class="mt0 mb0" colspan="2">7. Excess/Voluntary contribution to CPF by employer (less amount refunded/to be refunded):<br><b style="margin-left: 13px;">[See Explanatory Note 12d (IV)] and complete the Form IR8S)</b></p>
			</td>
			<td align="right"><p style="margin: 0;"><input type="text"></p></td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td>
				<p class="mb0 mt10" colspan="2">8. Gains or profits from Employee Stock Option (ESOP)/other forms of Employee Share Ownership (ESOW) Plans:<br><b style="margin-left: 13px;">[See Explanatory Note 12d (V)] and complete the Appendix 8B)</b></p>
			</td>
			<td align="right"><p style="margin: 0;"><input type="text"></p></td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td>
				<p class="mb0 mt10" colspan="2">9. Value of Benefits-in-kind <b>(See Explanatory Notes 13 to 16 and complete the Appendix 8A):</b></p>
			</td>
			<td align="right"><p style="margin: 0;"><input type="text"></p></td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td align="right">
				<p class="mb0 mt0" style="font-size: 14px;" colspan="2"><b>TOTAL (items d1 to d9)</b></p>
			</td>
			<td align="right"><p class="mt10"><input type="text"></p></td>
		</tr>

		<tr>
			<td valign="top"><p class="mt0">e) </p></td>
			<td>
				<p style="margin: 0;">Remission: Amount of Income: $ <input type="text"> <b>(See Explanatory Note 12e)</b><br>Exempt/Non Taxable Income: $ <input type="text" style="margin-top: 5px;"> <b>(See Explanatory Note 11)</b></p></td>
		</tr>

		<tr>
			<td valign="top"><p>f)</p> </td>
			<td colspan="2">
				<table class="mt10">
					<tr>
						<td class="bb p5" rowspan="4">
							<p style="margin: 0;">Employee’s income tax borne by employer?<br>* YES / NO</p>
						</td>
					</tr>
					<tr>
						<td class="bb p5" colspan="2">If yes and fully borne by employer, DO NOT enter any amount in (i) and (ii)</td>
					</tr>
					<tr>
						<td class="bb p5">(i) If tax is partially borne by employer, state the amount of income which tax is borne by employer</td>
						<td class="bb p5"><input type="text"></td>
					</tr>
					<tr>
						<td class="bb p5">(ii) If a fixed amount of tax is borne by employee, state the amount to be paid by employee</td>
						<td class="bb p5"><input type="text"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table style="margin-top: 20px;">
		<tr>
			<td bgcolor="#151515" class="vam tc bb" colspan="2"><p style="color: #fff; margin: 0;">DEDUCTIONS (Enter “NA” for items that are not applicable)</p></td>
		</tr>

		<tr>
			<td class="bb p5">
				<p style="margin: 0;">
				EMPLOYEE’S COMPULSORY contribution to *CPF/Designated Pension or Provident Fund (<b>less amount refunded/to be refunded</b>)<br>Name of Fund: <input type="text"><br>
				(Please apply the appropriate CPF rates published by CPF Board on its website ‘www.cpf.gov.sg’.  Do not include excess/voluntary contributions to CPF, voluntary contributions to Medisave Account, voluntary contributions to Retirement Sum Topping-up Scheme and SRS contributions in this item)
				<b>See Explanatory Note 12 - DEDUCTIONS</b></p>
			</td>
			<td class="bb p5">
				<input type="text">
			</td>
		</tr>

		<tr>
			<td class="bb p5">
				<p style="margin: 0;"><b>Donations</b> deducted from salaries for:<br>
				*Yayasan Mendaki Fund/Community Chest of Singapore/SINDA/CDAC/ECF/Other tax exempt donations</p>
			</td>
			<td class="bb p5"><input type="text"></td>
		</tr>

		<tr>
			<td class="bb p5">
				<p style="margin: 0;"><b>Contributions</b> deducted from salaries to Mosque Building Fund:</p>
			</td>
			<td class="bb p5"><input type="text"></td>
		</tr>

		<tr>
			<td class="bb p5">
				<p style="margin: 0;"><b>Life Insurance premiums</b> deducted from salaries:</p>
			</td>
			<td class="bb p5"><input type="text"></td>
		</tr>

		<tr>
			<td bgcolor="#151515" class="tc vam bb" colspan="2"><p class="tw m0">DECLARATION (See Explanatory Note 4)</p></td>
		</tr>

		<tr class="bb p5">
			<td colspan="6">
				<p style="margin: 10px;">Name of Employer: <input value="{{$setting->website}}" type="text" style="width: 80%;"></p>
				<p style="margin: 10px;">Address of Employer: <input type="text" value="{{$setting->address}}" style="width: 80%;"></p>
			</td>
		</tr>
	</table>
	<table style="margin-top: -1px; width: 961px; border: 1px solid #151515">
		<tr style="padding: 5px;">
			<td class="vam tc" style="padding: 3px; width: 30%;">
				<input type="text" style="width: 95%;">
				<p style="margin: 5px 0;">Name of authorised person making the declaration</p>
			</td>
			<td class="vam tc" style="padding: 3px; width: 15%;">
				<input type="text" style="width: 95%;">
				<p style="margin: 5px 0;">Designation</p>
			</td>
			<td class="vam tc" style="padding: 3px; width: 15%;">
				<input type="text" style="width: 95%;">
				<p style="margin: 5px 0;">Tel. No.</p>
			</td>
			<td class="vam tc" style="padding: 3px; width: 15%;">
				<input type="text" style="width: 95%;">
				<p style="margin: 5px 0;">Signature</p>
			</td>
			<td class="vam tc" style="padding: 3px; width: 15%;">
				<input type="text" style="width: 95%;">
				<p style="margin: 5px 0;">Date</p>
			</td>
		</tr>
	</table>
	<p style="text-align: center; font-family: sans-serif; font-size: 12px;"><b>There are penalties for failing to give a return or furnishing an incorrect or late return.</b></p>
	<table>
		<td align="left"><b>IR8A(1/2016)</b></td>
		<td align="right"><b>* Delete where applicable</b></td>
	</table>
</div>

</body>
</html>
