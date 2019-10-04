<?php

	include_once("../../sessionCheckPages.php");
	function getSupplierAddressIDs($con,$supID)
	{
		$get_query="SELECT ADDRESS_ID FROM SUPPLIER_ADDRESS WHERE SUPPLIER_ID='$supID'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			while($get_row=$get_result->fetch_assoc())
			{
				$get_vals[]=$get_row;
			}
			return $get_vals;
		}
		else
		{
			return false;
		}
	}
	//////////////////////////////////////////////////////
	function getAddressInfo($con,$addID)
	{
		$get_query="SELECT * FROM ADDRESS WHERE ADDRESS_ID='$addID'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$addressInfo=$row;
		}
		else
		{
			$addressInfo="Address does not exist";
		}
		return $addressInfo;
	}
	///////////////////////////////////////////////////////////
	function getSuburbInfo($con,$subID)
	{
		$get_query="SELECT * FROM SUBURB WHERE SUBURB_ID='$subID'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$suburbInfo=$row;
		}
		else
		{
			$suburbInfo="Address does not exist";
		}
		return $suburbInfo;
	}
	//////////////////////////////////////////////////////////
	function getCityInfo($con,$cityID)
	{
		$get_query="SELECT * FROM CITY WHERE CITY_ID='$cityID'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$cityInfo=$row;
		}
		else
		{
			$cityInfo="Address does not exist";
		}
		return $cityInfo;
	}
	///////////////////////////////////////////////////////
	function getEmployeeType($con,$employeeTypeID)
	{
		$get_query="SELECT * FROM EMPLOYEE_TYPE WHERE EMPLOYEE_TYPE_ID='$employeeTypeID'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$Info=$row;
		}
		else
		{
			$Info="Address does not exist";
		}
		return $Info;
	}
	//////////////////////////////////////////////////
	function getTitleInfo($con,$titleID)
	{
		$get_query="SELECT * FROM TITLE WHERE TITLE_ID='$titleID'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$Info=$row;
		}
		else
		{
			$Info="Address does not exist";
		}
		return $Info;
	}
	//////////////////////////////////////////////
	///////////////////////////////////////////////
	function checkSuburb($con,$suburbName)
	{
		$suburb_query="SELECT * FROM SUBURB WHERE NAME='$suburbName'";
		$suburb_result=mysqli_query($con,$suburb_query);
		if(mysqli_num_rows($suburb_result)>0)
		{
			return true;
		}
		else
		{
			return false;
		}
		

	}
	///////////////////////////////
	function checkCity($con,$cityName)
	{
		$city_query="SELECT * FROM CITY WHERE CITY_NAME='$cityName'";
		$city_result=mysqli_query($con,$city_query);
		if(mysqli_num_rows($city_result)>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	///////////////////////////////////
	function addSuburb($con,$suburbName,$cityID,$zip)
	{
		$add_query="INSERT INTO SUBURB (NAME,ZIPCODE,CITY_ID) VALUES ('$suburbName','$zip','$cityID')";
		$add_result=mysqli_query($con,$add_query);
		if($add_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//////////////////////////////////////////////
	function addCity($con,$cityName)
	{
		$add_query="INSERT INTO CITY (CITY_NAME) VALUES('$cityName')";
		$add_result=mysqli_query($con,$add_query);
		if($add_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	///////////////////////////////////////
	function getCityID($con,$cityName)
	{
		$get_query="SELECT * FROM CITY WHERE CITY_NAME='$cityName'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$cityID=$row["CITY_ID"];
		}
		else
		{
			$cityID="City ID does not exist";
		}
		return $cityID;
	}
	/////////////////////////////////////////
	function getSuburbID($con,$suburbName)
	{
		$get_query="SELECT * FROM SUBURB WHERE NAME='$suburbName'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$suburbID=$row["SUBURB_ID"];
		}
		else
		{
			$suburbID="Suburb does now exist";
		}
		return $suburbID;
	}
	/////////////////////////////////////////
	function addressCheck($con,$addressName)
	{
		$address_query="SELECT * FROM ADDRESS WHERE ADDRESS_LINE_1='$addressName'";
		$address_result=mysqli_query($con,$address_query);
		if(mysqli_num_rows($address_result)>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//////////////////////////////////////////////
	function addAddress($con,$addressName,$suburbID)
	{
		$add_query="INSERT INTO ADDRESS (ADDRESS_LINE_1,SUBURB_ID) VALUES ('$addressName','$suburbID')";
		$add_result=mysqli_query($con,$add_query);
		if($add_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	////////////////////////////////////
	function getAddressID($con,$addressName)
	{
		$get_query="SELECT * FROM ADDRESS WHERE ADDRESS_LINE_1='$addressName'";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$addressID=$row["ADDRESS_ID"];
		}
		else
		{
			$addressID="Address does not exist";
		}
		return $addressID;
	}
	//////////////////////////////////////////////////
	function checkEmployee($con,$name,$surname,$contact)
	{
		$check_query="SELECT * FROM EMPLOYEE WHERE NAME='$name' AND SURNAME='$surname' AND CONTACT_NUMBER='$contact'";
		$check_result=mysqli_query($con,$check_query);
		if(mysqli_num_rows($check_result)>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//////////////////////////////////////////////////
	function addEmployee($con,$name,$surname,$contact,$passID,$email,$addID,$titleID,$eTypeID,$eStatusID)
	{
		$add_query="INSERT INTO EMPLOYEE (NAME,SURNAME,CONTACT_NUMBER,EMAIL,IDENTITY_NUMBER,ADDRESS_ID,TITLE_ID,EMPLOYEE_TYPE_ID,EMPLOYEE_STATUS_ID) VALUES ('$name','$surname','$contact','$email','$passID','$addID','$titleID','$eTypeID','$eStatusID')";
		$add_result=mysqli_query($con,$add_query);
		$last_id = mysqli_insert_id($con);
		if($add_result)
		{

		    $DateAudit = date('Y-m-d H:i:s');
		    $Functionality_ID='2.1';
		   $userID = $_SESSION['userID'];
		    $changes="ID : ".$last_id."| Name : ".$name." ".$surname;
	        $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
	        $audit_result=mysqli_query($con,$audit_query);
	        if($audit_result)
	        {
	          
	        }
	        else
	        {
	          
	        }
			return true;
		}
		else
		{
			return false;
		}
	}
	///////////////////////////////////////////////////
	function getEmployeeID($con,$name,$surname,$contact)
	{
		$get_query="SELECT * FROM EMPLOYEE WHERE NAME='$name' AND SURNAME='$surname' AND CONTACT_NUMBER='$contact' ";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0)
		{
			$row=$get_result->fetch_assoc();
			$employeeID=$row["EMPLOYEE_ID"];
		}
		else
		{
			$employeeID="Employee does not exist";
		}
		return $employeeID;
	}
	///////////////////////////////////////////////////
	function addWage($con,$employeeID)
	{
		$add_query="INSERT INTO WAGE (EMPLOYEE_ID) VALUES('$employeeID')";
		$add_result=mysqli_query($con,$add_query);
		if($add_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	////////////////////////////////////////////////////
	/////////////////////////////////////////////////////
	function getAllEmployeeType($con)
	{
		$get_query="SELECT * FROM EMPLOYEE_TYPE";
		$get_result=mysqli_query($con,$get_query);
		if(mysqli_num_rows($get_result)>0){
			while($row=$get_result->fetch_assoc())
			{
				$vals[]=$row;
			}
			echo json_encode($vals);
		}
		else
		{
			echo "False";
		}
	}
	//////////////////////////////////////////////////////////
	function maintainEmployee($con,$id,$name,$surname,$contact,$email,$identity,$addID,$titleID,$employeeTypeID,$employeeStatusID)
	{
		$update_query="UPDATE EMPLOYEE SET NAME='$name',SURNAME='$surname',CONTACT_NUMBER='$contact',IDENTITY_NUMBER='$identity',EMAIL='$email',ADDRESS_ID='$addID',TITLE_ID='$titleID',EMPLOYEE_TYPE_ID='$employeeTypeID',EMPLOYEE_STATUS_ID='$employeeStatusID' WHERE EMPLOYEE_ID='$id'";
		$update_result=mysqli_query($con,$update_query);
		if($update_result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
?>